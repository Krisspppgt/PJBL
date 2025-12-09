@extends('admin.places.layout')
@section('title','Kelola Review')
@section('content')
<div class="mb-4">
  @if(session('success'))
    <div class="mb-3 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
  @endif

  <!-- Filter Form -->
  <form method="GET" class="bg-white p-4 rounded shadow mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <!-- Search -->
      <div>
        <input name="search"
               value="{{ request('search') }}"
               placeholder="Cari user, tempat, atau komentar..."
               class="w-full px-3 py-2 border rounded" />
      </div>

      <!-- Filter by Place -->
      <div>
        <select name="place_id" class="w-full px-3 py-2 border rounded">
          <option value="">Semua Tempat</option>
          @foreach($places as $place)
            <option value="{{ $place->id }}" {{ request('place_id') == $place->id ? 'selected' : '' }}>
              {{ $place->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Filter by Rating -->
      <div>
        <select name="rating" class="w-full px-3 py-2 border rounded">
          <option value="">Semua Rating</option>
          @for($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
              {{ $i }} ⭐
            </option>
          @endfor
        </select>
      </div>

      <!-- Filter Button -->
      <div class="flex gap-2">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          <i class="fas fa-search mr-2"></i>Filter
        </button>
        <a href="{{ route('admin.reviews.index') }}"
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
          Reset
        </a>
      </div>
    </div>
  </form>

  <!-- Reviews Table -->
  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th class="px-4 py-3 text-left">User</th>
          <th class="px-4 py-3 text-left">Tempat</th>
          <th class="px-4 py-3 text-left">Rating</th>
          <th class="px-4 py-3 text-left">Komentar</th>
          <th class="px-4 py-3 text-left">Tanggal</th>
          <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reviews as $review)
        <tr class="border-b hover:bg-gray-50">
          <!-- User -->
          <td class="px-4 py-3">
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                {{ substr($review->user->name, 0, 1) }}
              </div>
              <span class="font-medium">{{ $review->user->name }}</span>
            </div>
          </td>

          <!-- Place -->
          <td class="px-4 py-3">
            <a href="{{ route('admin.places.edit', $review->place->id) }}"
               class="text-blue-600 hover:underline">
              {{ Str::limit($review->place->name, 30) }}
            </a>
          </td>

          <!-- Rating -->
          <td class="px-4 py-3">
            <span class="text-yellow-500 font-bold">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)
                  ★
                @else
                  ☆
                @endif
              @endfor
            </span>
            <span class="text-gray-600 text-sm ml-1">({{ $review->rating }})</span>
          </td>

          <!-- Comment -->
          <td class="px-4 py-3">
            <p class="text-sm text-gray-700">{{ Str::limit($review->comment, 60) }}</p>
          </td>

          <!-- Date -->
          <td class="px-4 py-3 text-sm text-gray-600">
            {{ $review->created_at->format('d M Y') }}
            <br>
            <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
          </td>

          <!-- Actions -->
          <td class="px-4 py-3">
            <div class="flex justify-center gap-2">
              <a href="{{ route('admin.reviews.edit', $review->id) }}"
                 class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                Edit
              </a>
              <form action="{{ route('admin.reviews.destroy', $review->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus review ini?')"
                    class="inline">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                  Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-4 py-8 text-center text-gray-500">
            <i class="fas fa-inbox text-4xl mb-2"></i>
            <p>Tidak ada review ditemukan</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-6">
    {{ $reviews->links() }}
  </div>
</div>
@endsection
