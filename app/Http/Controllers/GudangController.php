<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gudang;

class gudangController extends Controller
{
    public function index()
    {
        $gudang = gudang::all();
        return view('gudang.index', compact('gudang'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas_total' => 'required|integer',
            'stok_saat_ini' => 'required|integer',
            'status_gudang' => 'required|string',
        ]);

        gudang::create($validated);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil ditambahkan');
    }

    public function show($id)
    {
        $gudang = gudang::findOrFail($id);
        return view('gudang.show', compact('gudang'));
    }

    public function edit($id)
    {
        $gudang = gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas_total' => 'required|integer',
            'stok_saat_ini' => 'required|integer',
            'status_gudang' => 'required|string',
        ]);

        $gudang = gudang::findOrFail($id);
        $gudang->update($validated);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diupdate');
    }

    public function destroy($id)
    {
        $gudang = gudang::findOrFail($id);
        $gudang->delete();

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus');
    }
}
