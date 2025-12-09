<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalSpot - @yield('title', 'Temukan Tempat Terbaik')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>
<body class="font-poppins bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 shadow-md p-4 md:px-8 flex justify-between items-center z-50 relative">
        <div class="flex justify-between items-center">
            <div class="flex flex-row justify-center items-center text-white font-bold text-xl gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Lokal Spot Logo" class="w-10 h-10 rounded-full"> Lokal Spot
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="/" class="text-white font-medium hover:text-yellow-500 transition">Home</a>
            <a href="{{ route('about') }}" class="text-white font-medium hover:text-yellow-500 transition">About Us</a>
            <div class="flex gap-3">
                <a href="{{ route('login') }}" class="px-4 py-2 border-2 border-white rounded-full text-white font-semibold hover:bg-white hover:text-[#2c3e50] transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition">Register</a>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
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
</body>
</html>
