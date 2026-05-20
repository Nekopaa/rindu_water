<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProdukAir;

class WelcomeController extends Controller
{
    /**
     * Show the welcome landing page.
     */
    public function index()
    {
        try {
            $produk = ProdukAir::where('status_produk', 'tersedia')->get();
        } catch (\Exception $e) {
            $produk = collect();
        }
        return view('welcomeblade', compact('produk'));
    }
}
