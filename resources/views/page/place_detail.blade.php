@extends('layouts.app')

@section('title', $place->name . ' - LocalSpot')

@section('styles')
<style>
    .star-rating {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 0.25rem;
        justify-content: flex-end;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        cursor: pointer;
        font-size: 2rem;
        color: #d1d5db;
        transition: color 0.2s;
    }

    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fbbf24;
    }
</style>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    <!-- Hero Image -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <img src="{{ $place->image ? asset('images/'.$place->image) : 'https://via.placeholder.com/1200x400' }}"
             alt="{{ $place->name }}"
             class="w-full max-w-3xl mx-auto h-auto object-cover rounded-lg shadow-lg">

        <!-- Title & Rating -->
        <h2 class="text-4xl font-bold text-black mt-6 mb-4">{{ $place->name }}</h2>
        <div class="flex flex-row items-center gap-2 mb-4">
            <span class="text-yellow-400 text-xl">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($place->rating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span>
            <span class="text-gray-600 text-lg">({{ number_format($place->rating, 1) }})</span>
            <span class="text-gray-500">{{ $place->reviews_count ?? 0 }} reviews</span>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-row gap-2 mb-6">
            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($place->address) }}"
               target="_blank"
               class="flex-1 p-3 rounded-lg bg-blue-800 text-center text-white font-bold hover:bg-blue-900">
                Direction
            </a>
            <button onclick="toggleFavorite({{ $place->id }}, this)"
                    class="p-3 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50"
                    data-place-id="{{ $place->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
            <button onclick="sharePlace()"
                    class="p-3 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>
            </button>
        </div>



        <!-- Description Section -->
        <div class="mb-8">
            <h2 class="font-bold text-2xl mb-3">Deskripsi</h2>
            <p class="text-gray-700 leading-relaxed">{{ $place->description ?? 'No description available.' }}</p>
        </div>

        <!-- Information Cards with Map Side by Side -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Left Side: Information Cards -->
            <div class="border-2 border-gray-200 rounded-xl overflow-hidden">
                <!-- Address Section -->
                @if($place->address)
                <div class="p-5 border-b-2 border-gray-200 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Alamat</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($place->address) }}"
                               target="_blank"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $place->address }}
                            </a>
                            @if($place->district)
                            <p class="text-gray-600 text-sm mt-1">{{ $place->district }}, Semarang</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Phone Section -->
                @if($place->phone)
                <div class="p-5 border-b-2 border-gray-200 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Nomor</p>
                            <a href="tel:{{ $place->phone }}"
                               class="text-blue-600 hover:underline font-medium text-lg">
                                {{ $place->phone }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Instagram Section -->
                @if($place->instagram)
                <div class="p-5 border-b-2 border-gray-200 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-pink-600">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Instagram</p>
                            <a href="https://instagram.com/{{ ltrim($place->instagram, '@') }}"
                               target="_blank"
                               class="text-blue-600 hover:underline font-medium">
                                {{ $place->instagram }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Hours Section -->
                @if($place->opening_hours)
                <div class="p-5 border-b-2 border-gray-200 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Jam Buka</p>
                            <p class="text-gray-800 font-medium">{{ $place->opening_hours }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Category Section -->
                <div class="p-5 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Kategori</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst(str_replace('-', ' ', $place->category)) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Google Maps -->
            <div class="h-full min-h-[400px]">
                <div class="w-full h-full rounded-xl overflow-hidden border-2 border-gray-200 shadow-lg">
                    <iframe
                        width="100%"
                        height="100%"
                        style="border:0; min-height: 400px;"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q={{ urlencode($place->address) }}&t=&z=15&ie=UTF8&iwloc=B&output=embed">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-black mb-6">Ulasan ({{ $reviews->total() }})</h2>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add Review Form - Only for Logged In Users -->
            @auth
            <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">Ceritakan Pengalamanmu</h3>

                <!-- Display Errors -->
                @if($errors->has('comment'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <p class="font-semibold">❌ {{ $errors->first('comment') }}</p>
                    </div>
                @endif

                <form action="{{ route('reviews.store', $place->id) }}" method="POST" id="reviewForm">
                    @csrf

                    <!-- Star Rating -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required />
                            <label for="star5">★</label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4">★</label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3">★</label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2">★</label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1">★</label>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Komen</label>
                        <textarea name="comment"
                                  rows="4"
                                  class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('comment') border-red-500 @enderror"
                                  placeholder="Bagikan pengalamanmu... (Jangan gunakan kata-kata kasar)"
                                  required>{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
            @endauth

            <!-- Reviews List -->
            <div class="space-y-6">
                @forelse($reviews as $review)
                <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-300 transition">
                    <div class="flex items-start gap-4">
                        <!-- User Avatar -->
                        <div class="rounded-full bg-blue-600 text-white w-12 h-12 flex items-center justify-center font-bold text-lg shrink-0">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>

                        <div class="flex-1">
                            <!-- User Info & Rating -->
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-bold text-lg">{{ $review->user->name }}</h4>
                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>

                            <!-- Stars -->
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-yellow-400 text-lg">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-gray-600">({{ $review->rating }}/5)</span>
                            </div>

                            <!-- Comment -->
                            <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>

                            <!-- Delete Button (only for review owner) -->
                            @if(auth()->check() && auth()->id() === $review->user_id)
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this review?')"
                                        class="text-sm text-red-600 hover:text-red-800 font-medium">
                                    Hapus Ulasan@extends('layouts.app')

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

    @keyframes heartPulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
    }

    .favorite-btn-top.active {
        animation: heartPulse 0.3s ease-in-out;
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
        justify-content: center;
        align-items: center;
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
    <form action="{{ route('homepage') }}" method="GET" class="w-full max-w-4xl mx-auto mt-6">
        <div class="flex items-center justify-center gap-3 w-full">
            <!-- Input Search -->
            <input
                type="text"
                name="search"
                id="searchInput"
                value="{{ request('search') }}"
                placeholder="Cari nama tempat atau kecamatan..."
                class="w-[55%] px-6 py-3 rounded-full text-black bg-white shadow-md focus:ring-2 focus:ring-amber-500 outline-none"
            >

            <!-- Dropdown -->
            <select
                name="district"
                class="w-[25%] px-6 py-3 rounded-full bg-white text-black shadow-md focus:ring-2 focus:ring-amber-500 outline-none"
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

            <!-- Hidden category input -->
            <input type="hidden" name="category" value="{{ request('category', 'all') }}">

            <!-- Tombol Cari -->
            <button type="submit"
                class="px-8 py-3 bg-amber-500 text-white rounded-full font-semibold hover:bg-amber-600 shadow-md flex items-center gap-2">
                <i class="fas fa-search"></i> Cari
            </button>

            <!-- Tombol Reset -->
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
    <div class="absolute left-1/2 -translate-x-1/2 mt-3 flex flex-wrap gap-2 justify-center w-full" style="top: 330px;">
        @if(request('search'))
            <span class="px-4 py-2 bg-white/30 backdrop-blur-md border border-white/20 text-white rounded-full text-sm">
                Pencarian: "{{ request('search') }}"
            </span>
        @endif

        @if(request('district'))
            <span class="px-4 py-2 bg-white/30 backdrop-blur-md border border-white/20 text-white rounded-full text-sm">
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
            <a href="?category=all{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'all' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'all' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-th"></i>
                </div>
                <span class="font-semibold text-sm">All</span>
            </a>
            <a href="?category=cafe{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'cafe' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'cafe' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-coffee"></i>
                </div>
                <span class="font-semibold text-sm">Cafe</span>
            </a>
            <a href="?category=restaurant{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'restaurant' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'restaurant' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="font-semibold text-sm">Restaurant</span>
            </a>
            <a href="?category=street-food{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'street-food' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'street-food' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-hamburger"></i>
                </div>
                <span class="font-semibold text-sm">Street Food</span>
            </a>
            <a href="?category=bakery{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'bakery' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'bakery' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-bread-slice"></i>
                </div>
                <span class="font-semibold text-sm">Bakery</span>
            </a>
            <a href="?category=drink-area{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'drink-area' ? 'bg-white text-amber-500' : 'text-white' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg {{ $category == 'drink-area' ? 'bg-amber-500 text-white' : 'bg-white text-amber-500' }}">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <span class="font-semibold text-sm">Drink Area</span>
            </a>
            <a href="?category=catering{{ request('search') ? '&search='.request('search') : '' }}{{ request('district') ? '&district='.request('district') : '' }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg transition transform hover:-translate-y-1 {{ $category == 'catering' ? 'bg-white text-amber-500' : 'text-white' }}">
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
                        <!-- Tombol Detail -->
                        <a href="/place/{{ $place->id }}" class="btn-detail w-full text-center justify-center">
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
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    if (!csrfToken) {
        console.error('CSRF token not found!');
        showNotification('CSRF token tidak ditemukan', 'error');
        return;
    }

    console.log('Toggling favorite for place:', placeId); // Debug
    console.log('Button element:', button); // Debug
    console.log('Button has active class:', button.classList.contains('active')); // Debug

    fetch(`/favorites/toggle/${placeId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status); // Debug
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data); // Debug

        // Update button appearance
        if (data.status === 'added') {
            button.classList.add('active');
            console.log('Added active class'); // Debug
        } else {
            button.classList.remove('active');
            console.log('Removed active class'); // Debug
        }

        // Show notification
        showNotification(data.message, data.status === 'added' ? 'success' : 'info');
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
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

    const icon = type === 'success' ? '✓' : type === 'info' ? 'ℹ' : '✗';
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
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchPlaces();
        }
    });
}

// Debug: Check if script loaded
console.log('Homepage scripts loaded successfully');
</script>
@endsection
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <p class="text-gray-500 text-lg">No reviews yet. Be the first to review!</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($reviews->hasPages())
            <div class="mt-8">
                {{ $reviews->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function sharePlace() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $place->name }}',
            text: 'Check out this place on LocalSpot!',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('Link copied to clipboard!');
    }
}

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
        const svg = button.querySelector('svg');
        if (data.status === 'added') {
            svg.setAttribute('fill', 'currentColor');
        } else {
            svg.setAttribute('fill', 'none');
        }
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endsection
