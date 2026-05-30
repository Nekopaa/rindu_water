<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pelanggan'  => 'required|in:individu,lembaga',
            'nama_pelanggan'   => 'required|string|max:255|unique:pelanggan,nama_pelanggan',
            'nama_lembaga'     => 'nullable|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'alamat'           => 'nullable|string',
            'no_telepon'       => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'tanggal_daftar'   => 'nullable|date',
            'status_pelanggan' => 'required|in:aktif,tidak aktif',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_pelanggan'  => 'required|in:individu,lembaga',
            'nama_pelanggan'   => 'required|string|max:255|unique:pelanggan,nama_pelanggan,' . $id . ',id_pelanggan',
            'nama_lembaga'     => 'nullable|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'alamat'           => 'nullable|string',
            'no_telepon'       => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'tanggal_daftar'   => 'nullable|date',
            'status_pelanggan' => 'required|in:aktif,tidak aktif',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
