@extends('admin.places.layout')
@section('title','Tambah Tempat')
@section('content')
<div class="max-w-3xl bg-white p-6 rounded shadow">
  <form action="{{ route('admin.places.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <input type="hidden" name="foursquare_id" value="{{ $data['foursquare_id'] ?? '' }}">

    <div>
      <label class="block mb-1 font-medium">Nama</label>
      <input name="name" value="{{ $data['name'] ?? old('name') }}" class="w-full border p-2 rounded" required>
    </div>

    <div>
      <label class="block mb-1">Kategori</label>
      <select name="category_id" class="w-full border p-2 rounded" required>
        @foreach(['cafe','restaurant','street-food','bakery','drink-area','catering'] as $cat)
          <option value="{{ $cat }}" {{ (old('category') == $cat) || (isset($data['category']) && $data['category']==$cat) ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block mb-1">Deskripsi</label>
      <textarea name="description" class="w-full border p-2 rounded h-24">{{ old('description') }}</textarea>
    </div>

    <div>
      <label class="block mb-1">Alamat</label>
      <textarea name="address" class="w-full border p-2 rounded h-20">{{ $data['address'] ?? old('address') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block mb-1">Latitude</label>
        <input name="latitude" value="{{ $data['latitude'] ?? '' }}" class="w-full border p-2 rounded">
      </div>
      <div>
        <label class="block mb-1">Longitude</label>
        <input name="longitude" value="{{ $data['longitude'] ?? '' }}" class="w-full border p-2 rounded">
      </div>
    </div>

    <div>
      <label class="block mb-1">Rating</label>
      <input name="rating" value="{{ $data['rating'] ?? '' }}" class="w-full border p-2 rounded">
    </div>

    <div>
      <label class="block mb-1">Reviews Count</label>
      <input name="reviews_count" value="{{ $data['reviews_count'] ?? '' }}" class="w-full border p-2 rounded">
    </div>

    <div>
      <label class="block mb-1">Telepon</label>
      <input name="phone" value="{{ $data['phone'] ?? '' }}" class="w-full border p-2 rounded">
    </div>

    <div>
      <label class="block mb-1">Jam Buka (raw)</label>
      <textarea name="opening_hours" class="w-full border p-2 rounded h-20">{{ $data['opening_hours'] ?? '' }}</textarea>
    </div>

    <div>
      <label class="block mb-1">Gambar (upload manual atau leave blank to use API image)</label>
      <input type="file" name="image" accept="image/*" class="w-full">
      @if(!empty($data['image_url']))
        <div class="mt-2">
          <img src="{{ $data['image_url'] }}" class="w-40 h-32 object-cover rounded">
          <input type="hidden" name="image_url" value="{{ $data['image_url'] }}">
        </div>
      @endif
    </div>

    <div class="flex gap-3 mt-4">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
      <a href="{{ route('admin.places.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
    </div>
  </form>
</div>
@endsection
