@extends('layouts.app')

@section('title', 'My Favorites - LocalSpot')

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
}

.place-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.place-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
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

.place-footer {
    display: flex;
    justify-content: space-between;
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
}

.btn-detail:hover {
    background: #2563eb;
}

.btn-remove {
    background: #ef4444;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-remove:hover {
    background: #dc2626;
}

.no-favorites {
    text-align: center;
    padding: 3rem 1rem;
    color: #64748b;
}

.no-favorites i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #cbd5e1;
}

.no-favorites h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}
</style>
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800">
            <i class="fas fa-heart text-red-500 mr-2"></i>Your Favorite Spot
        </h2>
        <a href="{{ route('homepage') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
            <i class="fas fa-arrow-left mr-1"></i> Back to Home
        </a>
    </div>

    @if($favorites->count() > 0)
        <div class="places-grid">
            @foreach($favorites as $place)
            <div class="place-card" data-place-id="{{ $place->id }}">
                <img src="{{ $place->image ? asset('images/'.$place->image) : 'https://via.placeholder.com/400x200' }}"
                     alt="{{ $place->name }}"
                     class="place-image">
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
                    <p class="place-description">{{ Str::limit($place->description, 100) }}</p>
                    <div class="place-footer">
                        <a href="/place/{{ $place->id }}" class="btn-detail">
                            <i class="fas fa-arrow-right"></i> Detail
                        </a>
                        <button onclick="removeFavorite({{ $place->id }})" class="btn-remove">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $favorites->links() }}
        </div>
    @else
        <div class="no-favorites">
            <i class="fas fa-heart-broken"></i>
            <h3>Belum ada tempat favorit</h3>
            <p>Mulai tambahkan tempat favorit Anda dari halaman utama</p>
            <a href="{{ route('homepage') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700">
                <i class="fas fa-search mr-2"></i>Jelajahi Tempat
            </a>
        </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
function removeFavorite(placeId) {
    if (confirm('Hapus dari favorit?')) {
        fetch(`/favorites/toggle/${placeId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'removed') {
                // Remove card from DOM
                const card = document.querySelector(`[data-place-id="${placeId}"]`);
                card.style.opacity = '0';
                setTimeout(() => {
                    card.remove();
                    // Reload if no more favorites
                    if (document.querySelectorAll('.place-card').length === 0) {
                        location.reload();
                    }
                }, 300);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection
