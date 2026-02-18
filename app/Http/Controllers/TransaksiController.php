<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;

class transaksiController extends Controller
{
    public function index()
    {
        $transaksi = transaksi::all();
        return view('transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pembayaran' => 'required|string',
        ]);

        $transaksi = transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diupdate');
    }
}
