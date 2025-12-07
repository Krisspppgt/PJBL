@extends('guest.layouts.app')

@section('title', 'Beranda - LocalSpot')

@section('styles')
    {{-- Styles converted to Tailwind utilities in markup; keep this section if you want to add small inline CSS later --}}
@endsection
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@section('content')
<!-- Hero Section -->
<section class="min-h-[450px] flex flex-col justify-center items-center text-white text-center p-8"
         style="background: linear-gradient(rgba(0,0,0,0.4), rgba(255, 255, 255, 0.4)), center/cover;"
         src="{{ asset('images/logo.jpeg') }}">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Menampilkan berbagai spot</h1>
    <p class="text-lg md:text-xl mb-6 drop-shadow">Temukan spot favorit mu di sekitarmu</p>

    <div class="flex gap-4 max-w-2xl w-full">
        <input type="text" placeholder="Cari spot ternyamanmu.." class="flex-1 px-4 py-3 rounded-full text-black outline-none" />
        <button class="px-6 py-3 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600">
            <i class="fas fa-search mr-2"></i> Cari
        </button>
    </div>
</section>

<!-- Categories -->
<section class="-mt-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4 bg-blue-900 p-6 rounded-xl shadow-lg">
        <a href="?category=all" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'all' ? 'bg-white' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'all' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-th"></i>
            </div>
            <span class="font-semibold text-sm">All</span>
        </a>
        <a href="?category=cafe" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'cafe' ? 'bg-white' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'cafe' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-coffee"></i>
            </div>
            <span class="font-semibold text-sm">Cafe</span>
        </a>
        <a href="?category=restaurant" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'restaurant' ? 'bg-white ' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'restaurant' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="font-semibold text-sm">Restaurant</span>
        </a>
        <a href="?category=street-food" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'street-food' ? 'bg-white ' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'street-food' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-hamburger"></i>
            </div>
            <span class="font-semibold text-sm">Street Food</span>
        </a>
        <a href="?category=bakery" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'bakery' ? 'bg-white' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'bakery' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-bread-slice"></i>
            </div>
            <span class="font-semibold text-sm">Bakery</span>
        </a>
        <a href="?category=drink-area" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'drink-area' ? 'bg-white' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'drink-area' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-glass-cheers"></i>
            </div>
            <span class="font-semibold text-sm">Drink Area</span>
        </a>
        <a href="?category=catering" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'catering' ? 'bg-white' : 'text-white' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'catering' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <span class="font-semibold text-sm">Catering</span>
        </a>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-6">
        @if($category == 'all')
            All Best For You
        @else
            {{ ucfirst(str_replace('-', ' ', $category)) }}
        @endif
    </h2>

    @if($places->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($places as $place)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- Image Container with Favorite Button -->
                <div class="relative h-48 overflow-hidden group">
                    <img src="{{ $place->image ?? 'https://via.placeholder.com/400x200' }}"
                         alt="{{ $place->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

                    <!-- Favorite Button (Guest) -->
                    @guest
                        <button onclick="showLoginPrompt()"
                                class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-50 transition-all duration-200">
                            <i class="far fa-heart text-red-500 text-lg"></i>
                        </button>
                    @else
                        <button onclick="toggleFavorite({{ $place->id }})"
                                class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-50 transition-all duration-200 favorite-btn"
                                data-place-id="{{ $place->id }}">
                            <i class="far fa-heart text-red-500 text-lg favorite-icon"></i>
                        </button>
                    @endguest

                    <!-- Category Badge -->
                    <div class="absolute top-3 left-3 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        {{ ucfirst(str_replace('-', ' ', $place->category)) }}
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-4">
                    <!-- Title and Rating -->
                    <div class="mb-2">
                        <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $place->name }}</h3>
                        <div class="flex items-center gap-1 text-sm">
                            <i class="fas fa-star text-amber-500"></i>
                            <span class="font-semibold text-slate-700">{{ $place->rating ?? '4.8' }}</span>
                            <span class="text-slate-500">({{ $place->reviews_count ?? '127' }} reviews)</span>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-2 text-sm text-slate-600 mb-3">
                        <i class="fas fa-map-marker-alt mt-1 text-red-500"></i>
                        <span class="line-clamp-2">{{ $place->address }}</span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ $place->description }}</p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($place->tags)
                            @foreach(explode(',', $place->tags) as $tag)
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">{{ trim($tag) }}</span>
                            @endforeach
                        @else
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Wifi</span>
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Parking</span>
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">AC</span>
                        @endif
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-3 border-t border-slate-200">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <i class="fas fa-route text-blue-500"></i>
                            <span class="font-semibold">{{ $place->distance ?? '2.5' }} km</span>
                        </div>
                        <a href="/place/{{ $place->id }}"
                           class="px-4 py-2 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600 transition-colors duration-200 flex items-center gap-2 text-sm">
                            Detail
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $places->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <i class="fas fa-search text-6xl text-slate-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">Tidak ada tempat ditemukan</h3>
            <p class="text-slate-500">Coba ubah kategori atau filter pencarian Anda</p>
        </div>
    @endif
</section>

<!-- Login Prompt Modal -->
<div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-heart text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Login Diperlukan</h3>
            <p class="text-slate-600 mb-6">Silakan login terlebih dahulu untuk menyimpan tempat favorit Anda</p>
            <div class="flex gap-3">
                <button onclick="closeLoginModal()"
                        class="flex-1 px-4 py-3 border-2 border-slate-300 text-slate-700 rounded-full font-semibold hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <a href="{{ route('login') }}"
                   class="flex-1 px-4 py-3 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600 transition-colors text-center">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Show login prompt for guest users
function showLoginPrompt() {
    document.getElementById('loginModal').classList.remove('hidden');
}

// Close login modal
function closeLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('loginModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeLoginModal();
    }
});

@auth
// Toggle Favorite Function (for authenticated users)
function toggleFavorite(placeId) {
    const button = document.querySelector(`button[data-place-id="${placeId}"]`);
    const icon = button.querySelector('.favorite-icon');

    // Toggle icon class
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        button.classList.add('animate-bounce');

        // Remove animation class after it completes
        setTimeout(() => {
            button.classList.remove('animate-bounce');
        }, 500);

        // Save favorite to database
        saveFavorite(placeId);
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');

        // Remove favorite from database
        removeFavorite(placeId);
    }
}

// Save favorite to database (AJAX)
function saveFavorite(placeId) {
    fetch(`/favorites/${placeId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ place_id: placeId })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Favorite saved:', data);
        // Optional: Show success message
        showToast('Ditambahkan ke favorit');
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Gagal menambahkan ke favorit', 'error');
    });
}

// Remove favorite from database (AJAX)
function removeFavorite(placeId) {
    fetch(`/favorites/${placeId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Favorite removed:', data);
        // Optional: Show success message
        showToast('Dihapus dari favorit');
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Gagal menghapus dari favorit', 'error');
    });
}

// Load favorites on page load
document.addEventListener('DOMContentLoaded', function() {
    fetch('/favorites')
        .then(response => response.json())
        .then(data => {
            if (data.favorites) {
                data.favorites.forEach(placeId => {
                    const button = document.querySelector(`button[data-place-id="${placeId}"]`);
                    if (button) {
                        const icon = button.querySelector('.favorite-icon');
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error loading favorites:', error);
        });
});

// Simple toast notification function
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-full shadow-lg text-white font-semibold z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}
@endauth
</script>
@endsection
