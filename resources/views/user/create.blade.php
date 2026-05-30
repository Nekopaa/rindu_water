@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-white font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all mb-6 gap-2">
        ⬅️ Kembali ke Daftar Akun
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4">
            <h3 class="text-xl font-black text-black">Formulir Pendaftaran Pengguna Baru</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Buat akun pembeli atau admin baru dengan mendaftarkan email aktif.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block font-black text-sm text-black">Nama Lengkap Pengguna <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" class="neo-brutal-input" value="{{ old('name') }}" required placeholder="Contoh: Rian Hidayat">
                @error('name') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block font-black text-sm text-black">Alamat Email Pengguna <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" class="neo-brutal-input" value="{{ old('email') }}" required placeholder="Contoh: rian@example.com">
                @error('email') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Passwords -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="password" class="block font-black text-sm text-black">Password Pengguna <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" class="neo-brutal-input" required placeholder="Minimal 6 karakter">
                    @error('password') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block font-black text-sm text-black">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="neo-brutal-input" required placeholder="Tulis ulang password">
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-4 border-3 border-black rounded-xl bg-[#4ade80] font-black text-sm text-black shadow-[4px_4px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                💾 Daftarkan Akun Pengguna
            </button>
        </form>
    </div>
</div>
@endsection
