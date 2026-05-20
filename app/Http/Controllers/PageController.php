<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

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
        return view('history');
    }
    
    public function help() {
        return view('help');
    }
    
    public function beli() {
        return view('beli');
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
