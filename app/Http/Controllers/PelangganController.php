<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;

class pelangganController extends Controller
{
    public function index()
    {
        $pelanggan = pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pelanggan = pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        $pelanggan = pelanggan::findOrFail($id);
        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelanggan = pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
