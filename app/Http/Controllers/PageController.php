<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function index(Request $request) {
        $produkRandom = Produk::inRandomOrder()->take(3)->get();

        return view('index', compact('produkRandom'));
    }

    public function history(Request $request) {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $status = $request->query('status', 'all');
        $query = $request->query('q', '');
        $allowedFilters = ['all', 'proses', 'success', 'failed'];
        if (!in_array($status, $allowedFilters)) {
            $status = 'all';
        }

        $orders = Order::with('product');

        if (auth()->user()->role !== 'admin') {
            $orders->where('user_id', auth()->id());
        }

        if ($status === 'all') {
            $orders->whereIn('status', ['proses', 'success', 'failed']);
        } else {
            $orders->where('status', $status);
        }

        if (!empty($query)) {
            $orders->where(function ($subQuery) use ($query) {
                $subQuery->where('email', 'like', "%{$query}%")
                    ->orWhere('customer_name', 'like', "%{$query}%")
                    ->orWhereHas('product', function ($productQuery) use ($query) {
                        $productQuery->where('nama_barang', 'like', "%{$query}%");
                    });
            });
        }

        $orders = $orders->latest()->get();

        return view('history', compact('orders', 'status', 'query'));
    }

    public function customers()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-users', compact('users'));
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

    protected function getTopBuyers() {
        $topBuyers = Order::with('product')
            ->where('status', 'success')
            ->get()
            ->groupBy('email')
            ->map(function ($orders, $email) {
                $totalQuantity = $orders->sum('quantity');
                $totalPaid = $orders->sum('total');
                $topCategory = $orders
                    ->groupBy(fn($order) => $order->product?->kategori ?? 'Lainnya')
                    ->sortByDesc(fn($group) => $group->sum('quantity'))
                    ->keys()
                    ->first();

                return (object) [
                    'customer_name' => $orders->first()->customer_name,
                    'email' => $email,
                    'category' => $topCategory,
                    'total_quantity' => $totalQuantity,
                    'total_paid' => $totalPaid,
                ];
            })
            ->sortByDesc(fn($buyer) => $buyer->total_quantity)
            ->take(5)
            ->values();

        return $topBuyers;
    }

    public function beliForm() {
        $topBuyers = $this->getTopBuyers();
        return view('beli', compact('topBuyers'));
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
        $productId = $validated['product_id'] ?? null;

        if ($productId) {
            $product = Produk::find($productId);
            $price = $product ? $product->harga : 0;
        }

        if ($product && $validated['quantity'] > $product->stok) {
            return back()->withInput()->withErrors(['quantity' => 'Maaf, stok tidak cukup untuk jumlah pesanan ini.']);
        }

        $productId = $validated['product_id'] ?? null;

        $order = DB::transaction(function () use ($validated, $product, $price, $productId) {
            if ($product) {
                $product->decrement('stok', $validated['quantity']);
            }

            return Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $productId,
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'quantity' => $validated['quantity'],
                'price' => $price,
                'total' => $price * $validated['quantity'],
                'status' => 'proses',
            ]);
        });

        return redirect()->route('beli.qris', ['order' => $order->id]);
    }

    public function beli(Produk $product) {
        $topBuyers = $this->getTopBuyers();
        return view('beli', compact('product', 'topBuyers'));
    }

    public function qris(Order $order)
    {
        $qrisCode = sprintf('QRIS-%s', random_int(10000000, 99999999));
        $qrData = urlencode('ORDER:' . $order->id . '|AMOUNT:' . $order->total . '|CODE:' . $qrisCode);

        return view('qris', compact('order', 'qrisCode', 'qrData'));
    }

    public function completeOrder(Order $order)
    {
        // Keep status as proses until admin manually confirms the payment.
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
