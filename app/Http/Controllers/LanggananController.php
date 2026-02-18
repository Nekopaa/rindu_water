<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\langganan;

class langgananController extends Controller
{
    public function index()
    {
        $langganan = langganan::all();
        return view('langganan.index', compact('langganan'));
    }

    public function create()
    {
        return view('langganan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_pengantaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jumlah_pesanan' => 'required|integer',
            'status_langganan' => 'required|string',
        ]);

        langganan::create($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil ditambahkan');
    }

    public function show($id)
    {
        $langganan = langganan::findOrFail($id);
        return view('langganan.show', compact('langganan'));
    }

    public function edit($id)
    {
        $langganan = langganan::findOrFail($id);
        return view('langganan.edit', compact('langganan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'periode_pengantaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jumlah_pesanan' => 'required|integer',
            'status_langganan' => 'required|string',
        ]);

        $langganan = langganan::findOrFail($id);
        $langganan->update($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil diupdate');
    }

    public function destroy($id)
    {
        $langganan = langganan::findOrFail($id);
        $langganan->delete();

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil dihapus');
    }
}
