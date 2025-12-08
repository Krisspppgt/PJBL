@extends('admin.places.layout')
@section('title','Daftar Tempat')
@section('content')
<div class="mb-4">
  @if(session('success'))
    <div class="mb-3 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="mb-3 px-4 py-2 bg-red-100 text-red-800 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="flex justify-between items-center">
  <div class="flex gap-2">
    <form class="flex gap-2" method="GET">
      <input name="search" value="{{ request('search') }}" placeholder="Cari..." class="px-3 py-2 border rounded" />
      <select name="category" class="px-3 py-2 border rounded">
        <option value="">Semua Kategori</option>
        @foreach(['cafe','restaurant','street-food','bakery','drink-area','catering'] as $cat)
          <option value="{{ $cat }}" {{ request('category')==$cat?'selected':'' }}>{{ ucfirst($cat) }}</option>
        @endforeach
      </select>
      <button class="px-3 py-2 bg-blue-600 text-white rounded">Filter</button>
    </form>
  </div>
  <div class="flex gap-2">
   
    <a href="{{ route('admin.places.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Tambah</a>
  </div>
</div>

<div class="grid grid-cols-3 gap-4">
  @foreach($places as $p)
    <div class="bg-white rounded shadow p-4">
      <div class="h-40 bg-gray-100 mb-3 flex items-center justify-center overflow-hidden">
        @if($p->image)
          <img src="{{ asset('images/'.$p->image) }}" class="object-cover w-full h-full" alt="{{ $p->name }}">
        @else
          <div class="text-gray-400">No Image</div>
        @endif
      </div>
      <h3 class="font-semibold text-lg">{{ $p->name }}</h3>
      <p class="text-sm text-gray-600">{{ $p->category }} • {{ $p->rating }} ⭐</p>
      <p class="text-sm mt-2 text-gray-700">{{ Str::limit($p->address, 80) }}</p>
      <div class="mt-4 flex gap-2">
        <a href="{{ route('admin.places.edit', $p->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
        <form action="{{ route('admin.places.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')" class="inline">
          @csrf @method('DELETE')
          <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $places->links() }}
</div>
@endsection
