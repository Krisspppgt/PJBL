<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Local Spot')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-map-marked-alt text-2xl mr-2"></i>
                    <h1 class="text-xl font-bold">Local Spot Admin</h1>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-home mr-3"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.spots.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.spots.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-map-marker-alt mr-3"></i> Spots
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-layer-group mr-3"></i> Categories
                    </a>
                    <a href="{{ route('admin.reviews.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.reviews.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-star mr-3"></i> Reviews
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                        <i class="fas fa-users mr-3"></i> Users
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6 border-t border-gray-800">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-arrow-left mr-3"></i> Back to Site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-gray-800 text-left">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
                <h2 class="text-2xl font-bold">@yield('page-title', 'Dashboard')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

