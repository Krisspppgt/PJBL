@extends('layouts.app')

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
        <div class="places-grid">
            @foreach($places as $place)
            <div class="place-card ">
                <img src="{{ $place->image ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $place->name }}" class="place-image">
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
                        <span>{{ $place->address }}</span>
                    </div>
                    <p class="place-description">{{ $place->description }}</p>
                    <div class="place-tags">
                        @if($place->tags)
                            @foreach(explode(',', $place->tags) as $tag)
                                <span class="tag">{{ trim($tag) }}</span>
                            @endforeach
                        @else
                            <span class="tag">Wifi</span>
                            <span class="tag">Parking</span>
                            <span class="tag">AC</span>
                        @endif
                    </div>
                    <div class="place-footer">
                        <div class="place-distance">
                            <i class="fas fa-route"></i>
                            <span>{{ $place->distance ?? '2.5' }} km</span>
                        </div>
                        <a href="/place/{{ $place->id }}" class="btn-detail">
                            <i class="fas fa-arrow-right"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: 2rem;">
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
