@extends('admin.places.layout')

@section('title', 'Edit Place - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Place</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.places.update', $place->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $place->name) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label for="address" class="block font-medium">Address</label>
            <textarea name="address" id="address" class="w-full border rounded p-2" required>{{ old('address', $place->address) }}</textarea>
        </div>

        <div>
            <label for="category" class="block font-medium">Category</label>
            <select name="category" id="category" class="w-full border rounded p-2" required>
                @foreach(['cafe','restaurant','street-food','bakery','drink-area','catering'] as $cat)
                    <option value="{{ $cat }}" {{ (old('category') == $cat || $place->category == $cat) ? 'selected' : '' }}>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="district" class="block font-medium">Kecamatan</label>
            <select name="district" id="district" class="w-full border rounded p-2" required>
                <option value="">Pilih Kecamatan</option>
                <option value="Semarang Tengah" {{ old('district', $place->district) == 'Semarang Tengah' ? 'selected' : '' }}>Semarang Tengah</option>
                <option value="Semarang Utara" {{ old('district', $place->district) == 'Semarang Utara' ? 'selected' : '' }}>Semarang Utara</option>
                <option value="Semarang Timur" {{ old('district', $place->district) == 'Semarang Timur' ? 'selected' : '' }}>Semarang Timur</option>
                <option value="Semarang Selatan" {{ old('district', $place->district) == 'Semarang Selatan' ? 'selected' : '' }}>Semarang Selatan</option>
                <option value="Semarang Barat" {{ old('district', $place->district) == 'Semarang Barat' ? 'selected' : '' }}>Semarang Barat</option>
                <option value="Gayamsari" {{ old('district', $place->district) == 'Gayamsari' ? 'selected' : '' }}>Gayamsari</option>
                <option value="Genuk" {{ old('district', $place->district) == 'Genuk' ? 'selected' : '' }}>Genuk</option>
                <option value="Pedurungan" {{ old('district', $place->district) == 'Pedurungan' ? 'selected' : '' }}>Pedurungan</option>
                <option value="Tembalang" {{ old('district', $place->district) == 'Tembalang' ? 'selected' : '' }}>Tembalang</option>
                <option value="Banyumanik" {{ old('district', $place->district) == 'Banyumanik' ? 'selected' : '' }}>Banyumanik</option>
                <option value="Gunungpati" {{ old('district', $place->district) == 'Gunungpati' ? 'selected' : '' }}>Gunungpati</option>
                <option value="Mijen" {{ old('district', $place->district) == 'Mijen' ? 'selected' : '' }}>Mijen</option>
                <option value="Ngaliyan" {{ old('district', $place->district) == 'Ngaliyan' ? 'selected' : '' }}>Ngaliyan</option>
                <option value="Tugu" {{ old('district', $place->district) == 'Tugu' ? 'selected' : '' }}>Tugu</option>
                <option value="Candisari" {{ old('district', $place->district) == 'Candisari' ? 'selected' : '' }}>Candisari</option>
                <option value="Gajahmungkur" {{ old('district', $place->district) == 'Gajahmungkur' ? 'selected' : '' }}>Gajahmungkur</option>
            </select>
        </div>

        <div>
            <label for="instagram" class="block font-medium">Instagram</label>
            <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $place->instagram) }}"
                   class="w-full border rounded p-2" placeholder="@namatempat">
        </div>

        <div>
            <label for="foursquare_id" class="block font-medium">Foursquare ID</label>
            <input type="text" name="foursquare_id" id="foursquare_id" value="{{ old('foursquare_id', $place->foursquare_id) }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label for="image" class="block font-medium">Image</label>
            @if($place->image)
                <div class="mb-2">
                    <img src="{{ asset('public/images/' . $place->image) }}" alt="Place Image" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" id="image" class="w-full border rounded p-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Place
            </button>
            <a href="{{ route('admin.places.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection