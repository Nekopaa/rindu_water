<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\riwayat_stock;

class riwayatStockController extends Controller
{
    public function index()
    {
        $riwayat = riwayat_stock::all();
        return view('riwayat_stock.index', compact('riwayat'));
    }

    public function show($id)
    {
        $riwayat = riwayat_stock::findOrFail($id);
        return view('riwayat_stock.show', compact('riwayat'));
    }
}
