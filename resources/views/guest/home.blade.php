@extends('guest.layouts.app')

@section('title', 'Beranda - LocalSpot')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200') center/cover;
        min-height: 450px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 2rem;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .search-bar {
        display: flex;
        gap: 1rem;
        max-width: 600px;
        width: 100%;
    }

    .search-bar input {
        flex: 1;
        padding: 1rem;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
    }

    .search-bar button {
        padding: 1rem 2rem;
        background-color: #f39c12;
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-bar button:hover {
        background-color: #e67e22;
    }

    /* Categories */
    .categories {
        max-width: 1200px;
        margin: -50px auto 3rem;
        padding: 0 2rem;
        position: relative;
        z-index: 10;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s;
        cursor: pointer;
    }

    .category-item:hover {
        background-color: #fff5e6;
        transform: translateY(-5px);
    }

    .category-item.active {
        background-color: #f39c12;
        color: white;
    }

    .category-icon {
        width: 50px;
        height: 50px;
        background-color: #f39c12;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .category-item.active .category-icon {
        background-color: white;
        color: #f39c12;
    }

    .category-name {
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Content Section */
    .content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 3rem;
    }

    .section-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
    }

    /* Places Grid */
    .places-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .place-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .place-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .place-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .place-content {
        padding: 1.5rem;
    }

    .place-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .place-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.3rem;
    }

    .place-rating {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: #f39c12;
        font-weight: 600;
    }

    .place-category {
        display: inline-block;
        padding: 0.3rem 1rem;
        background-color: #fff5e6;
        color: #f39c12;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .place-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .place-description {
        color: #7f8c8d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .place-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .tag {
        padding: 0.3rem 0.8rem;
        background-color: #f8f9fa;
        border-radius: 15px;
        font-size: 0.8rem;
        color: #7f8c8d;
    }

    .place-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #ecf0f1;
    }

    .place-distance {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .btn-detail {
        padding: 0.6rem 1.5rem;
        background-color: #8b4513;
        color: white;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .btn-detail:hover {
        background-color: #6d3410;
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 3rem;
        color: #7f8c8d;
    }

    .no-results i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #bdc3c7;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <h1>Menampilkan berbagai spot</h1>
    <p>Temukan spot favorit mu di sekitarmu</p>
    <div class="search-bar">
        <input type="text" placeholder=" Cari spot ternyamanmu..">
        <button><i class="fas fa-search"></i> Cari</button>
    </div>
</section>

<!-- Categories -->
<section class="categories">
    <div class="categories-grid">
        <a href="?category=all" class="category-item {{ $category == 'all' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-th"></i>
            </div>
            <span class="category-name">All</span>
        </a>
        <a href="?category=cafe" class="category-item {{ $category == 'cafe' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-coffee"></i>
            </div>
            <span class="category-name">Cafe</span>
        </a>
        <a href="?category=restaurant" class="category-item {{ $category == 'restaurant' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="category-name">Restaurant</span>
        </a>
        <a href="?category=street-food" class="category-item {{ $category == 'street-food' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-hamburger"></i>
            </div>
            <span class="category-name">Street Food</span>
        </a>
        <a href="?category=bakery" class="category-item {{ $category == 'bakery' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-bread-slice"></i>
            </div>
            <span class="category-name">Bakery</span>
        </a>
        <a href="?category=drink-area" class="category-item {{ $category == 'drink-area' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-glass-cheers"></i>
            </div>
            <span class="category-name">Drink Area</span>
        </a>
        <a href="?category=catering" class="category-item {{ $category == 'catering' ? 'active' : '' }}">
            <div class="category-icon">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <span class="category-name">Catering</span>
        </a>
    </div>
</section>

<!-- Content Section -->
<section class="content">
    <h2 class="section-title">
        @if($category == 'all')
            All Best For You
        @else
            {{ ucfirst(str_replace('-', ' ', $category)) }}
        @endif
    </h2>

    @if($places->count() > 0)
        <div class="places-grid">
            @foreach($places as $place)
            <div class="place-card">
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
