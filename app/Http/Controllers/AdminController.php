<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaksi;
use App\Models\Langganan;
use App\Models\ProdukAir;
use App\Models\Pelanggan;
use App\Models\Kurir;
use App\Models\Pengiriman;
use App\Models\Gudang;
use App\Models\LaporanPenjualan;
use App\Models\RiwayatStock;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::whereIn('status_transaksi', ['dibayar', 'dikirim', 'selesai'])->sum('total_bayar');
        $totalLangganan = Langganan::where('status_langganan', 'aktif')->count();
        $totalPelanggan = Pelanggan::count();
        
        $lowStockProducts = ProdukAir::where('stok', '<', 15)->get();
        $activeShipments = Pengiriman::whereIn('status_pengiriman', ['proses', 'dikirim'])->count();
        
        $recentTransactions = Transaksi::with('pelanggan')->latest()->take(5)->get();
        $recentShipments = Pengiriman::with(['transaksi.pelanggan', 'kurir'])->latest()->take(5)->get();
        $stockHistory = RiwayatStock::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalLangganan',
            'totalPelanggan',
            'lowStockProducts',
            'activeShipments',
            'recentTransactions',
            'recentShipments',
            'stockHistory'
        ));
    }

    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:admins,email',
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        Admin::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
