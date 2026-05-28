<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function index(Request $request) {
        $produkRandom = Produk::inRandomOrder()->take(3)->get();

        if ($request->user()) {
            $waktuSekarang = now()->format('d M Y, H:i:s');

            if (!$request->session()->has('first_visit')) {
                $request->session()->put('first_visit', $waktuSekarang);
                $request->session()->put('visit_count', 0);
            }

            $request->session()->increment('visit_count');
            $request->session()->put('last_visit', $waktuSekarang);
        }

        return view('index', compact('produkRandom'));
    }

    public function resetKunjungan(Request $request) {
        $request->session()->forget(['first_visit', 'last_visit', 'visit_count']);
        return redirect()->back()->with('success', 'Statistik hitungan kunjungan lo berhasil direset dari awal!');
    }

    public function history() {
        $orders = Order::with('product');

        if (auth()->user()->role !== 'admin') {
            $orders->where('user_id', auth()->id());
        }

        $orders = $orders->latest()->get();

        return view('history', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,success,failed'],
        ]);

        $previousStatus = $order->status;
        $newStatus = $validated['status'];

        DB::transaction(function () use ($order, $previousStatus, $newStatus) {
            $product = $order->product;

            if ($product) {
                if ($previousStatus !== 'failed' && $newStatus === 'failed') {
                    $product->increment('stok', $order->quantity);
                }

                if ($previousStatus === 'failed' && $newStatus !== 'failed') {
                    if ($product->stok < $order->quantity) {
                        throw ValidationException::withMessages([
                            'status' => ['Stok tidak mencukupi untuk mengaktifkan kembali pesanan ini.'],
                        ]);
                    }
                    $product->decrement('stok', $order->quantity);
                }
            }

            $order->update(['status' => $newStatus]);
        });

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function help() {
        return view('help');
    }

    public function beliForm() {
        return view('beli');
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['nullable', 'exists:produks,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'payment_method' => ['required', 'string', 'in:QRIS,E-wallet,Virtual Account'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = null;
        $price = 0;

        if ($validated['product_id']) {
            $product = Produk::find($validated['product_id']);
            $price = $product ? $product->harga : 0;
        }

        if ($product && $validated['quantity'] > $product->stok) {
            return back()->withInput()->withErrors(['quantity' => 'Maaf, stok tidak cukup untuk jumlah pesanan ini.']);
        }

        $order = DB::transaction(function () use ($validated, $product, $price) {
            if ($product) {
                $product->decrement('stok', $validated['quantity']);
            }

            return Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $validated['product_id'],
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'quantity' => $validated['quantity'],
                'price' => $price,
                'total' => $price * $validated['quantity'],
                'status' => 'pending',
            ]);
        });

        return redirect()->route('beli.qris', ['order' => $order->id]);
    }

    public function beli(Produk $product) {
        return view('beli', compact('product'));
    }

    public function qris(Order $order)
    {
        $qrisCode = sprintf('QRIS-%s', random_int(10000000, 99999999));
        $qrData = urlencode('ORDER:' . $order->id . '|AMOUNT:' . $order->total . '|CODE:' . $qrisCode);

        return view('qris', compact('order', 'qrisCode', 'qrData'));
    }

    public function completeOrder(Order $order)
    {
        $order->update(['status' => 'success']);

        return redirect()->route('beli.qris.success', ['order' => $order->id]);
    }

    public function qrisSuccess(Order $order)
    {
        return view('qris-success', compact('order'));
    }

    public function pengaturan(Request $request) {
        $theme = $request->cookie('theme', 'system');
        $fontSize = $request->cookie('font_size', 'normal');

        return view('pengaturan', compact('theme', 'fontSize'));
    }

    public function simpanPengaturan(Request $request) {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark,system'],
            'font_size' => ['required', 'in:kecil,normal,besar'],
        ]);

        $theme = $validated['theme'];
        $fontSize = $validated['font_size'];

        $cookieTheme = cookie('theme', $theme, 43200);
        $cookieFont = cookie('font_size', $fontSize, 43200);

        return response()->json([
            'status' => 'success',
            'message' => 'Tema ' . strtoupper($theme) . ' dan ukuran font berhasil diterapkan!',
            'theme' => $theme,
            'font_size' => $fontSize
        ])->withCookie($cookieTheme)->withCookie($cookieFont);
    }
}
