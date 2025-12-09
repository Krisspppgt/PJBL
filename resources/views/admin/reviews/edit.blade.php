@extends('admin.places.layout')
@section('title','Edit Review')
@section('content')
<div class="max-w-3xl bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-6">Edit Review</h2>

  @if($errors->any())
    <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Review Info -->
  <div class="mb-6 p-4 bg-gray-50 rounded">
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-600">User</label>
        <p class="font-semibold">{{ $review->user->name }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-600">Tempat</label>
        <p class="font-semibold">{{ $review->place->name }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-600">Tanggal</label>
        <p class="text-sm">{{ $review->created_at->format('d M Y H:i') }}</p>
      </div>
    </div>
  </div>

  <!-- Edit Form -->
  <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Rating -->
    <div class="mb-4">
      <label class="block mb-2 font-medium">Rating</label>
      <div class="flex gap-2">
        @for($i = 1; $i <= 5; $i++)
          <label class="cursor-pointer">
            <input type="radio"
                   name="rating"
                   value="{{ $i }}"
                   {{ old('rating', $review->rating) == $i ? 'checked' : '' }}
                   class="hidden peer"
                   required>
            <span class="text-3xl peer-checked:text-yellow-500 text-gray-300 hover:text-yellow-400">
              ★
            </span>
          </label>
        @endfor
      </div>
    </div>

    <!-- Comment -->
    <div class="mb-6">
      <label class="block mb-2 font-medium">Komentar</label>
      <textarea name="comment"
                rows="6"
                class="w-full border p-3 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>{{ old('comment', $review->comment) }}</textarea>
      <p class="text-sm text-gray-500 mt-1">Minimal 10 karakter, maksimal 1000 karakter</p>
    </div>

    <!-- Buttons -->
    <div class="flex gap-3">
      <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Simpan Perubahan
      </button>
      <a href="{{ route('admin.reviews.index') }}"
         class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
