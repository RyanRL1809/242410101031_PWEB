<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('index');
    }

    public function list_produk() {
        $data = Produk::all(); 
        return view('list_produk', compact('data'));
    }

    public function produk() {
        $data = Produk::all(); 
        return view('produk', compact('data'));
    }
    
    public function store_produk(Request $request) {
        Produk::create([
            'kode_barang'   => $request->kode,
            'nama_barang'   => $request->nama,
            'kategori'      => $request->kategori,
            'stok'          => $request->stok,
            'harga'         => $request->harga,
            'tanggal_masuk' => $request->tanggal,
        ]);
        return redirect()->back()->with('success', 'Produk berhasil ditambah!');
    }

    public function hapus_produk($id) {
        Produk::destroy($id);
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function history() {
        return view('history');
    }
    
    public function help() {
        return view('help');
    }
    
    public function beli() {
        return view('beli');
    }
}