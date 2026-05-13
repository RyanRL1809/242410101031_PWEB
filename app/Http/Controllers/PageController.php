<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class PageController extends Controller
{
    public function index() {
        $produkRandom = Produk::inRandomOrder()->take(3)->get();

        return view('index', compact('produkRandom'));
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
