<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = Produk::paginate(10);
        $kodeBerikutnya = $this->buatKodeBarang();

        $topProducts = Order::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total) as total_revenue'))
            ->where('status', 'success')
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        return view('produk', compact('data', 'kodeBerikutnya', 'topProducts'));
    }

    public function catalog()
    {
        $data = Produk::paginate(8);

        return view('list_produk', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'kategori' => 'required|in:Steam Wallet,Epic Games Wallet,Ubisoft Wallet',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:1000',
            'tanggal' => 'required|date',
        ]);

        Produk::create([
            'kode_barang'   => $this->buatKodeBarang(),
            'nama_barang'   => $request->nama,
            'kategori'      => $request->kategori,
            'stok'          => $request->stok,
            'harga'         => $request->harga,
            'tanggal_masuk' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambah!');
    }

    public function edit(Produk $product)
    {
        return view('edit', compact('product'));
    }

    public function update(Request $request, Produk $product)
    {
        $request->validate([
            'kode_barang' => 'required|unique:produks,kode_barang,' . $product->id,
            'nama_barang' => 'required|min:3|max:255',
            'kategori' => 'required|in:Steam Wallet,Epic Games Wallet,Ubisoft Wallet',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:1000',
            'tanggal_masuk' => 'required|date',
        ]);

        $product->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Produk $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    private function buatKodeBarang(): string
    {
        $nomorTerakhir = Produk::pluck('kode_barang')
            ->map(function ($kode) {
                if (preg_match('/^SW-(\d+)$/', $kode, $matches)) {
                    return (int) $matches[1];
                }

                return 0;
            })
            ->max();

        return 'SW-' . str_pad(($nomorTerakhir ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');

        $hasilPencarian = Produk::where('nama_barang', 'like', "%{$keyword}%")
                                ->orWhere('kategori', 'like', "%{$keyword}%")
                                ->orWhere('harga', 'like', "%{$keyword}%")
                                ->get();

        return response()->json($hasilPencarian);
    }
}
