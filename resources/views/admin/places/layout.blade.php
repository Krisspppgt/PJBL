<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin - @yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

  <aside class="w-64 bg-white shadow h-screen fixed">
    <div class="p-6 text-xl font-bold">🍽 KulinerAdmin</div>
    <nav class="mt-4">
      <a href="{{ route('admin.places.index') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.index') ? 'bg-gray-100 font-semibold' : '' }}">Daftar Tempat</a>
      <a href="{{ route('admin.places.search') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.search') ? 'bg-gray-100 font-semibold' : '' }}">Cari via Foursquare</a>
      <a href="{{ route('admin.places.create') }}" class="block px-6 py-3 hover:bg-gray-100 {{ request()->routeIs('admin.places.create') ? 'bg-gray-100 font-semibold' : '' }}">Tambah Manual</a>
    </nav>
  </aside>

  <div class="flex-1 ml-64">
    <header class="h-16 bg-white shadow flex items-center justify-between px-6">
      <div>@yield('title')</div>
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

</body>
</html>
