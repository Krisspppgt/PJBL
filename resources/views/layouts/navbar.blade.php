<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>
<body>
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 p-3 shadow-md flex flex-row justify-between items-center">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex flex-row justify-center items-center text-white font-bold text-xl gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Lokal Spot Logo" class="w-10 h-10 rounded-full"> Lokal Spot
            </div>
        </div>

        <div class="text-white text-lg font-medium">
            <a href="/homepage" class="hover:text-yellow-400">Home</a>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Profile Link -->
                    <x-dropdown-link :href="route('profile.edit')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Profile
                    </x-dropdown-link>

                    <!-- Favorites Link -->
                    <x-dropdown-link :href="route('favorites.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline mr-2 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        Favorites
                    </x-dropdown-link>

                    <!-- Divider -->
                    <div class="border-t border-gray-100"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-stone-950 via-black to-neutral-400 text-white mt-12 p-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-yellow-500 text-lg font-semibold mb-2">Alamat</h3>
                <p>Jl. Pandanaran 2 No.12, Mugassari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50249</p>
            </div>
            <div>
                <h3 class="text-yellow-500 text-lg font-semibold mb-2">Kontak</h3>
                <p>Email: localspot@gmail.com</p>
                <p>No. Telp: 081317690545</p>
            </div>
        </div>
        <div class="text-center mt-8 border-t border-white/20 pt-4">
            <p>&copy; 2025 Local Spot by Kelompok 1</p>
        </div>
    </footer>

    @yield('scripts')

    <!-- WAJIB ADA: Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
