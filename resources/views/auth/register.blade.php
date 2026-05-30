<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label :value="__('Daftar sebagai')" />
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="role" value="user" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('role', 'user') === 'user' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">Pelanggan</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="role" value="admin" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('role') === 'admin' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">Admin</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Company Code (for admin) -->
        <div class="mt-4" id="company_code_container" style="display: {{ old('role') === 'admin' ? 'block' : 'none' }};">
            <x-input-label for="company_code" :value="__('Kode Perusahaan')" />
            <x-text-input id="company_code" class="block mt-1 w-full" type="text" name="company_code" :value="old('company_code')" autocomplete="off" />
            <x-input-error :messages="$errors->get('company_code')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">Masukkan kode "PRIMA" untuk mendaftar sebagai admin</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const companyCodeContainer = document.getElementById('company_code_container');
            
            roleRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'admin') {
                        companyCodeContainer.style.display = 'block';
                    } else {
                        companyCodeContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-guest-layout>