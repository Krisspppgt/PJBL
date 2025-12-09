<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin - @yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex" x-data="{ open: false }">

  <!-- Mobile Menu Button -->
  <button
      @click="open = true"
      class="lg:hidden fixed top-4 left-4 z-40 bg-black shadow px-3 py-2 rounded-lg">
      <i class="fa-solid fa-bars text-xl"></i>
  </button>

  <!-- Sidebar (Desktop) -->
  <aside class="w-64 bg-white shadow h-screen fixed hidden lg:block">
    <div class="p-6 text-xl font-bold">🍽 KulinerAdmin</div>
    <nav class="mt-4">
  <a href="{{ route('admin.places.index') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.index') ? 'bg-gray-100 font-semibold' : '' }}">Daftar Tempat</a>

  <a href="{{ route('admin.places.create') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.create') ? 'bg-gray-100 font-semibold' : '' }}">Tambah</a>

  <!-- Menu Reviews Baru -->
  <a href="{{ route('admin.reviews.index') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.reviews.*') ? 'bg-gray-100 font-semibold' : '' }}">
    <i class="fas fa-star mr-2"></i>Kelola Review
  </a>
</nav>

  </aside>

  <!-- Sidebar (Mobile Drawer) -->
  <aside
      class="w-64 bg-white shadow h-screen fixed top-0 left-0 transform -translate-x-full transition-all duration-300 z-50 lg:hidden"
      :class="open ? 'translate-x-0' : '-translate-x-full'"
  >
      <div class="p-6 text-xl font-bold flex justify-between items-center">
          🍽 KulinerAdmin
          <button @click="open = false"><i class="fas fa-times text-xl"></i></button>
      </div>

      <nav class="mt-4">
        <a href="{{ route('admin.places.index') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.index') ? 'bg-gray-100 font-semibold' : '' }}">Daftar Tempat</a>

        <a href="{{ route('admin.places.create') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.create') ? 'bg-gray-100 font-semibold' : '' }}">Tambah</a>
      </nav>
  </aside>

  <!-- Overlay (Mobile) -->
  <div
      class="fixed inset-0 bg-black bg-opacity-40 z-40 lg:hidden"
      x-show="open"
      @click="open = false"
      x-transition
  ></div>

  <!-- Main Content -->
  <div class="flex-1 lg:ml-64 w-full">
    <header class="h-16 bg-white shadow flex items-center justify-between px-6">
      <div class="font-semibold">@yield('title')</div>
      <div class="flex items-center gap-3">
        <span class="text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-sm bg-red-500 text-white px-3 py-1 rounded">Logout</button></form>
      </div>
    </header>

    <main class="p-6">
      @if(session('success'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>@endif
      @yield('content')
    </main>
  </div>

  <!-- Alpine JS -->
  <script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>
