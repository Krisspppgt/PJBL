@extends('guest.layouts.app')

@section('title', 'Beranda - LocalSpot')

@section('styles')
<style>
    .place-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .place-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .place-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="min-h-[450px] flex flex-col justify-center items-center text-white text-center p-8 pb-32 relative bg-cover bg-center"
         style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ asset('images/hero-background.jpeg') }}');">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Menampilkan berbagai spot</h1>
    <p class="text-lg md:text-xl mb-6 drop-shadow">Temukan spot favorit mu di sekitarmu</p>

    <!-- Search Form -->
   <form action="{{ route('homepage') }}" method="GET" class="w-full max-w-4xl">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <input type="text"
                   name="search"
                   id="searchInput"
                   value="{{ request('search') }}"
                   placeholder="Cari nama tempat atau kecamatan..."
                   class="flex-1 px-4 py-3 rounded-full text-black outline-none" />

            <!-- District Filter -->
            <select name="district"
                    class="px-4 py-3 rounded-full text-black outline-none bg-white">
                <option value="">Semua Kecamatan</option>
                <option value="Semarang Tengah" {{ request('district') == 'Semarang Tengah' ? 'selected' : '' }}>Semarang Tengah</option>
                <option value="Semarang Utara" {{ request('district') == 'Semarang Utara' ? 'selected' : '' }}>Semarang Utara</option>
                <option value="Semarang Timur" {{ request('district') == 'Semarang Timur' ? 'selected' : '' }}>Semarang Timur</option>
                <option value="Semarang Selatan" {{ request('district') == 'Semarang Selatan' ? 'selected' : '' }}>Semarang Selatan</option>
                <option value="Semarang Barat" {{ request('district') == 'Semarang Barat' ? 'selected' : '' }}>Semarang Barat</option>
                <option value="Gayamsari" {{ request('district') == 'Gayamsari' ? 'selected' : '' }}>Gayamsari</option>
                <option value="Genuk" {{ request('district') == 'Genuk' ? 'selected' : '' }}>Genuk</option>
                <option value="Pedurungan" {{ request('district') == 'Pedurungan' ? 'selected' : '' }}>Pedurungan</option>
                <option value="Tembalang" {{ request('district') == 'Tembalang' ? 'selected' : '' }}>Tembalang</option>
                <option value="Banyumanik" {{ request('district') == 'Banyumanik' ? 'selected' : '' }}>Banyumanik</option>
                <option value="Gunungpati" {{ request('district') == 'Gunungpati' ? 'selected' : '' }}>Gunungpati</option>
                <option value="Mijen" {{ request('district') == 'Mijen' ? 'selected' : '' }}>Mijen</option>
                <option value="Ngaliyan" {{ request('district') == 'Ngaliyan' ? 'selected' : '' }}>Ngaliyan</option>
                <option value="Tugu" {{ request('district') == 'Tugu' ? 'selected' : '' }}>Tugu</option>
                <option value="Candisari" {{ request('district') == 'Candisari' ? 'selected' : '' }}>Candisari</option>
                <option value="Gajahmungkur" {{ request('district') == 'Gajahmungkur' ? 'selected' : '' }}>Gajahmungkur</option>
            </select>

            <!-- Preserve category filter -->
            <input type="hidden" name="category" value="{{ request('category', 'all') }}">

            <!-- Search Button -->
            <button type="submit" class="px-6 py-3 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600 whitespace-nowrap">
                <i class="fas fa-search mr-2"></i> Cari
            </button>

            <!-- Reset Button (if filters applied) -->
            @if(request('search') || request('district'))
            <a href="{{ route('homepage') }}?category={{ request('category', 'all') }}"
               class="px-6 py-3 bg-gray-500 text-white rounded-full font-semibold hover:bg-gray-600 flex items-center whitespace-nowrap">
                <i class="fas fa-times mr-2"></i> Reset
            </a>
            @endif
        </div>
    </form>

    <!-- Active Filters Display -->
    @if(request('search') || request('district'))
    <div class="mt-4 flex flex-wrap gap-2 justify-center">
        @if(request('search'))
        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm">
            <i class="fas fa-search mr-1"></i> Pencarian: "{{ request('search') }}"
        </span>
        @endif
        @if(request('district'))
        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm">
            <i class="fas fa-map-marker-alt mr-1"></i> Kecamatan: {{ request('district') }}
        </span>
        @endif
    </div>
    @endif
</section>

<!-- Categories -->
<section class="-mt-16 relative z-10 w-full">
    <div class="w-full bg-[#183883] rounded-t-xl p-6 shadow-lg">
       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4 p-6">
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
            <a href="?category=restaurant" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'restaurant' ? 'bg-white' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'restaurant' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="font-semibold text-sm">Restaurant</span>
            </a>
            <a href="?category=street-food" class="flex flex-col items-center gap-2 p-4 rounded-lg text-amber-500 transition transform hover:-translate-y-1 {{ $category == 'street-food' ? 'bg-white' : 'text-white' }}">
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
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 place-card">
                <!-- Image Container with Favorite Button -->
                <div class="relative h-48 overflow-hidden group">
                    <img src="{{ $place->image ? asset('images/'.$place->image) : 'https://via.placeholder.com/400x200' }}"
                         alt="{{ $place->name }}"
                         class="place-image">

                    <!-- Favorite Button (Guest) -->
                    <button onclick="showLoginPrompt()"
                            class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-50 transition-all duration-200">
                        <i class="fas fa-heart text-gray-500 text-lg"></i>
                    </button>
                </div>

                <!-- Card Content -->
                <div class="p-4">
                    <!-- Category Badge -->
                    <div class="w-fit bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-semibold mb-2">
                        {{ ucfirst(str_replace('-', ' ', $place->category)) }}
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $place->name }}</h3>

                    <!-- Rating -->
                    <div class="flex items-center gap-1 text-sm mb-2">
                        <i class="fas fa-star text-amber-500"></i>
                        <span class="font-semibold text-slate-700">{{ $place->rating ?? '4.8' }}</span>
                        <span class="text-slate-500">({{ $place->reviews_count ?? '127' }} reviews)</span>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-2 text-sm text-slate-600 mb-3">
                        <i class="fas fa-map-marker-alt mt-1 text-red-500"></i>
                        <span class="line-clamp-2">{{ $place->address }}</span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ $place->description }}</p>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-3 border-t border-slate-200">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                        </div>
                        <button onclick="showLoginPrompt()"
                                class="px-4 py-2 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600 transition-colors duration-200 flex items-center gap-2 text-sm">
                            Detail
                            <i class="fas fa-arrow-right"></i>
                        </button>
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
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Login Diperlukan</h3>
            <p class="text-slate-600 mb-6">Silakan login terlebih dahulu untuk melihat detail tempat dan menambahkan favorit</p>
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
@endsection

@section('scripts')
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
</script>
@endsection
