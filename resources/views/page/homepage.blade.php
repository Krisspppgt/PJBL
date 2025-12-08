@extends('layouts.app')

@section('title', 'Beranda - LocalSpot')

@section('styles')
<style>
    .places-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .place-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }

    .place-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .place-image-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
    }

    .place-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .favorite-btn-top {
        position: absolute;
        top: 12px;
        right: 12px;
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s;
        z-index: 10;
    }

    .favorite-btn-top:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .favorite-btn-top i {
        font-size: 1.25rem;
        color: #9ca3af;
        transition: color 0.3s;
    }

    .favorite-btn-top.active i {
        color: #ef4444;
    }

    .place-content {
        padding: 1rem;
    }

    .place-category {
        display: inline-block;
        background: #3b82f6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .place-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
    }

    .place-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0.5rem 0;
        color: #1e293b;
    }

    .place-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: #f59e0b;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .place-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }

    .place-description {
        color: #475569;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .place-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .tag {
        background: #f1f5f9;
        color: #64748b;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
    }

    .place-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .place-distance {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.875rem;
    }

    .btn-detail {
        background: #3b82f6;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-detail:hover {
        background: #2563eb;
    }

    .no-results {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
    }

    .no-results i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #cbd5e1;
    }

    .no-results h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #3b82f6;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
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
<form action="{{ route('homepage') }}" method="GET"
    class="w-full max-w-4xl mx-auto mt-6">

    <div class="flex items-center justify-center gap-3 w-full">

    <!-- Input Search -->
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama tempat atau kecamatan..."
        class="w-[55%] px-6 py-3 rounded-full text-black bg-white shadow-md
        focus:ring-2 focus:ring-amber-500 outline-none"
    >

    <!-- Dropdown -->
    <select
        name="district"
        class="w-[25%] px-6 py-3 rounded-full bg-white text-black shadow-md
            focus:ring-2 focus:ring-amber-500 outline-none"
    >
        <option value="">Semua Kecamatan</option>
        @foreach([
            "Semarang Tengah","Semarang Utara","Semarang Timur","Semarang Selatan",
            "Semarang Barat","Gayamsari","Genuk","Pedurungan","Tembalang","Banyumanik",
            "Gunungpati","Mijen","Ngaliyan","Tugu","Candisari","Gajahmungkur"
        ] as $dist)
            <option value="{{ $dist }}" {{ request('district') == $dist ? 'selected' : '' }}>
                {{ $dist }}
            </option>
        @endforeach
    </select>

    <!-- Tombol Cari -->
    <button type="submit"
        class="px-8 py-3 bg-amber-500 text-white rounded-full font-semibold
        hover:bg-amber-600 shadow-md flex items-center gap-2">
        <i class="fas fa-search"></i> Cari
    </button>

    <!-- Tombol Reset -->
    @if(request('search') || request('district'))
        <a href="{{ route('homepage') }}"
            class="px-6 py-3 bg-gray-500 text-white rounded-full font-semibold hover:bg-gray-600 flex items-center whitespace-nowrap">
                <i class="fas fa-times mr-2"></i> Reset
        </a>
    @endif
</div>
</form>


 <!-- #region -->

    <!-- Active Filters Display -->
    @if (request('search') || request('district'))
    <div class="absolute left-1/2 -translate-x-1/2 mt-3
                flex flex-wrap gap-2 justify-center w-full"
         style="top: 330px;">

        @if(request('search'))
            <span class="px-4 py-2 bg-white/30 backdrop-blur-md border border-white/20
                         text-white rounded-full text-sm">
                Pencarian: "{{ request('search') }}"
            </span>
        @endif

        @if(request('district'))
            <span class="px-4 py-2 bg-white/30 backdrop-blur-md border border-white/20
                         text-white rounded-full text-sm">
                Kecamatan: {{ request('district') }}
            </span>
        @endif
    </div>
@endif

</section>

<!-- Categories -->
<section class="-mt-16 relative z-10 w-full">
    <div class="w-full bg-[#183883] rounded-t-xl p-6 shadow-lg">
       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4 p-6">
            <a href="?category=all" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'all' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'all' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-th"></i>
                </div>
                <span class="font-semibold text-sm">All</span>
            </a>
            <a href="?category=cafe" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'cafe' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'cafe' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-coffee"></i>
                </div>
                <span class="font-semibold text-sm">Cafe</span>
            </a>
            <a href="?category=restaurant" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'restaurant' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'restaurant' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="font-semibold text-sm">Restaurant</span>
            </a>
            <a href="?category=street-food" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'street-food' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'street-food' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-hamburger"></i>
                </div>
                <span class="font-semibold text-sm">Street Food</span>
            </a>
            <a href="?category=bakery" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'bakery' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'bakery' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-bread-slice"></i>
                </div>
                <span class="font-semibold text-sm">Bakery</span>
            </a>
            <a href="?category=drink-area" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'drink-area' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'drink-area' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <span class="font-semibold text-sm">Drink Area</span>
            </a>
            <a href="?category=catering" class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'catering' ? 'bg-white text-amber-500' : 'text-white' }}">
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
        <div class="places-grid">
            @foreach($places as $place)
            <div class="place-card" data-place-id="{{ $place->id }}">
                <!-- Image with Favorite Button -->
                <div class="place-image-wrapper">
                    <img src="{{ $place->image ? asset('images/'.$place->image) : 'https://via.placeholder.com/400x200' }}"
                         alt="{{ $place->name }}"
                         class="place-image">

                    <!-- Favorite Button di Pojok Kanan Atas -->
                    <button onclick="toggleFavorite({{ $place->id }}, this)"
                            class="favorite-btn-top {{ auth()->user()->favoritePlaces->contains($place->id) ? 'active' : '' }}"
                            data-place-id="{{ $place->id }}"
                            title="Add to favorites">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>

                <!-- Content -->
                <div class="place-content">
                    <span class="place-category">{{ ucfirst(str_replace('-', ' ', $place->category)) }}</span>
                    <div class="place-header">
                        <div>
                            <h3 class="place-title">{{ $place->name }}</h3>
                            <div class="place-rating">
                                <i class="fas fa-star"></i>
                                <span>{{ $place->rating ?? '4.8' }}</span>
                                <span style="color: #7f8c8d;">({{ $place->reviews_count ?? '127' }} reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="place-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ Str::limit($place->address, 50) }}</span>
                    </div>
                    <p class="place-description">{{ Str::limit($place->description, 100) }}</p>
                    <div class="place-footer">
                        <div class="place-distance">
                            <i class="fas fa-route"></i>
                            <span>{{ $place->distance ?? '2.5' }} km</span>
                        </div>
                        <!-- Tombol Detail -->
                        <a href="/place/{{ $place->id }}" class="btn-detail">
                            <i class="fas fa-arrow-right"></i> Detail
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
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h3>Tidak ada tempat ditemukan</h3>
            <p>Coba ubah kategori atau filter pencarian Anda</p>
        </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
// Toggle Favorite Function
function toggleFavorite(placeId, button) {
    fetch(`/favorites/toggle/${placeId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update button appearance
        if (data.status === 'added') {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }

        // Show notification
        showNotification(data.message, data.status === 'added' ? 'success' : 'info');
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Show Notification Function
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = 'notification';

    const colors = {
        success: '#10b981',
        info: '#3b82f6',
        error: '#ef4444'
    };

    notification.style.background = colors[type] || colors.success;

    const icon = type = == 'success' ? '✓' : type === 'info' ? 'ℹ' : '✗';
    notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span style="font-size: 1.25rem;">${icon}</span>
            <span>${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease-out reverse';
        setTimeout(() => notification.remove(), 300);
    }, 2500);
}

// Search Function
function searchPlaces() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.trim();

    if (searchTerm) {
        window.location.href = `/homepage?search=${encodeURIComponent(searchTerm)}`;
    }
}

// Enter key to search
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchPlaces();
    }
});
</script>
@endsection
