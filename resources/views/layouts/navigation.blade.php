<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 w-full z-50 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    {{-- Link logo dinamis: mengarah ke dashboard jika login, ke home jika tidak --}}
                    @auth
                        {{-- [PERBAIKAN 1: LOGIKA LOGO 3-ROLE] --}}
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                            </a>
                        @elseif (auth()->user()->role == 'psikolog')
                            <a href="{{ route('psikolog.dashboard') }}">
                                <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}">
                                <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/') }}">
                            <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                        </a>
                    @endauth
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        {{-- Logika ini sudah benar (hanya user yg lihat) --}}
                        @if (Auth::user()->role === 'user')
                            <a href="{{ route('user.dashboard') }}#home"
                                class="nav-link-animated inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">Home</a>
                            <a href="{{ route('user.dashboard') }}#tentang"
                                class="nav-link-animated inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">Tentang
                                Kami</a>
                            <a href="{{ route('user.dashboard') }}#layanan"
                                class="nav-link-animated inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">Layanan</a>
                            <a href="{{ route('user.dashboard') }}#kontak"
                                class="nav-link-animated inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">Kontak</a>
                        @endif
                        {{-- Admin & Psikolog tidak melihat link ini --}}
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Login Buttons -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- JIKA SUDAH LOGIN, TAMPILKAN DROPDOWN --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- [PERBAIKAN 2: LOGIKA DROPDOWN 3-ROLE] --}}
                            @if (Auth::user()->role === 'admin')
                                {{-- UNTUK ADMIN --}}
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Admin Dashboard') }}
                                </x-dropdown-link>
                            @elseif (Auth::user()->role === 'psikolog')
                                {{-- UNTUK PSIKOLOG --}}
                                <x-dropdown-link :href="route('psikolog.dashboard')">
                                    {{ __('Psikolog Dashboard') }}
                                </x-dropdown-link>
                            @else
                                {{-- UNTUK USER BIASA --}}
                                <x-dropdown-link :href="route('user.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.konseling.index')">
                                    {{ __('Riwayat Konseling') }}
                                </x-dropdown-link>
                            @endif

                            {{-- LINK YANG SAMA UNTUK SEMUA ROLE --}}
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- JIKA BELUM LOGIN, TAMPILKAN TOMBOL --}}
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 nav-button nav-button-secondary">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ms-4 font-semibold text-gray-600 hover:text-gray-900 nav-button nav-button-primary">Register</a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        {{-- [PERBAIKAN 3: LOGIKA MOBILE 3-ROLE] --}}
        @auth
            @if (Auth::user()->role === 'user')
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('user.dashboard') }}#home"
                        class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Home</a>
                    <a href="{{ route('user.dashboard') }}#tentang"
                        class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Tentang
                        Kami</a>
                    <a href="{{ route('user.dashboard') }}#layanan"
                        class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Layanan</a>
                    <a href="{{ route('user.dashboard') }}#kontak"
                        class="block ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Kontak</a>
                </div>
            @endif
        @endauth

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if (Auth::user()->role === 'admin')
                        <x-responsive-nav-link :href="route('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-responsive-nav-link>
                    @elseif (Auth::user()->role === 'psikolog')
                        <x-responsive-nav-link :href="route('psikolog.dashboard')">
                            {{ __('Psikolog Dashboard') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('user.dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('user.konseling.index')">
                            {{ __('Riwayat Konseling') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        {{-- Tampilkan menu login/register untuk GUEST di mobile --}}
        @guest
            <div class="pt-4 pb-3 border-t border-gray-200 space-y-2">
                <a href="{{ route('login') }}"
                    class="block ps-3 pe-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50">Log
                    in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block ps-3 pe-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50">Register</a>
                @endif
            </div>
        @endguest
    </div>
</nav>
