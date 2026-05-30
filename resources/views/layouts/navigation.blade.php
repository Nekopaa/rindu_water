<nav x-data="{ open: false }" class="bg-white border-b-4 border-black sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="block p-1 bg-[#facc15] border-3 border-black rounded-full shadow-[2px_2px_0px_#000000] hover:scale-105 transition-transform duration-300">
                        <x-application-logo class="block h-9 w-9 text-black" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 border-3 border-black rounded-xl font-extrabold text-sm {{ request()->routeIs('dashboard') ? 'bg-[#facc15] shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black transition-all duration-150">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-3 border-black text-sm leading-4 font-extrabold rounded-xl text-black bg-[#facc15] shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:shadow-[1px_1px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 focus:outline-none transition-all duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- We override content styling in dropdown-link or apply custom class -->
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold text-black border-b-2 border-black hover:bg-slate-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="font-bold text-red-600 hover:bg-red-50">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-xl border-3 border-black text-black bg-[#facc15] shadow-[3px_3px_0px_#000000] hover:shadow-[4px_4px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:shadow-[1px_1px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 focus:outline-none transition-all duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t-3 border-black py-4">
        <div class="pt-2 pb-3 space-y-2 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl font-extrabold text-black border-3 border-black {{ request()->routeIs('dashboard') ? 'bg-[#facc15] shadow-[3px_3px_0px_#000000]' : 'bg-white' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t-3 border-black">
            <div class="px-6 py-2">
                <div class="font-extrabold text-base text-black">{{ Auth::user()->name }}</div>
                <div class="font-bold text-sm text-slate-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-2 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl font-extrabold text-black border-3 border-black bg-white shadow-[3px_3px_0px_#000000] hover:translate-x-0.5 hover:translate-y-0.5">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full text-left block px-4 py-3 rounded-xl font-extrabold text-red-600 border-3 border-black bg-white shadow-[3px_3px_0px_#000000] hover:translate-x-0.5 hover:translate-y-0.5">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
