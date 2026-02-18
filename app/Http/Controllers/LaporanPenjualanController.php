<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporan_penjualan;

class laporanPenjualanController extends Controller
{
    public function index()
    {
        $laporan = laporan_penjualan::all();
        return view('laporan_penjualan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = laporan_penjualan::findOrFail($id);
        return view('laporan_penjualan.show', compact('laporan'));
    }
}
