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
