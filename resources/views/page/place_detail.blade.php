@extends('layouts.app')

@section('title', $place->name . ' - LocalSpot')

@section('styles')
<style>
    .star-rating {
        display: inline-flex;
        gap: 0.25rem;
    }
    
    .star-rating input {
        display: none;
    }
    
    .star-rating label {
        cursor: pointer;
        font-size: 1.5rem;
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
                        &#9733;
                    @else
                        &#9734;
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
            <h2 class="font-bold text-2xl mb-3">Description</h2>
            <p class="text-gray-700 leading-relaxed">{{ $place->description ?? 'No description available.' }}</p>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            @if($place->opening_hours)
            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-500 transition">
                <p class="font-bold text-lg mb-2">⏰ Hours</p>
                <p class="text-gray-600">{{ $place->opening_hours }}</p>
            </div>
            @endif

            @if($place->instagram)
            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-500 transition">
                <p class="font-bold text-lg mb-2">📸 Instagram</p>
                <a href="https://instagram.com/{{ ltrim($place->instagram, '@') }}" 
                   target="_blank"
                   class="text-blue-600 hover:underline">{{ $place->instagram }}</a>
            </div>
            @endif

            @if($place->phone)
            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-500 transition">
                <p class="font-bold text-lg mb-2">📞 Phone</p>
                <a href="tel:{{ $place->phone }}" class="text-blue-600 hover:underline">{{ $place->phone }}</a>
            </div>
            @endif

            @if($place->district)
            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-500 transition">
                <p class="font-bold text-lg mb-2">📍 District</p>
                <p class="text-gray-600">{{ $place->district }}</p>
            </div>
            @endif

            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-500 transition">
                <p class="font-bold text-lg mb-2">🏷️ Category</p>
                <p class="text-gray-600">{{ ucfirst(str_replace('-', ' ', $place->category)) }}</p>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-black mb-6">Reviews ({{ $reviews->count() }})</h2>

            <!-- Add Review Form - Only for Logged In Users -->
            @auth
            <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">Write Your Review</h3>
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
                        <label class="block font-medium mb-2">Comment</label>
                        <textarea name="comment" 
                                  rows="4" 
                                  class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" 
                                  placeholder="Share your experience..."
                                  required></textarea>
                    </div>

                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        Submit Review
                    </button>
                </form>
            </div>
            @else
            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6 mb-8 text-center">
                <p class="text-lg mb-3">Please <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">login</a> to write a review</p>
            </div>
            @endauth

            <!-- Reviews List -->
            <div class="space-y-6">
                @forelse($reviews as $review)
                <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-300 transition">
                    <div class="flex items-start gap-4">
                        <!-- User Avatar -->
                        <div class="rounded-full bg-blue-600 text-white w-12 h-12 flex items-center justify-center font-bold text-lg">
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
                                <span class="text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            &#9733;
                                        @else
                                            &#9734;
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-gray-600">({{ $review->rating }}.0)</span>
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
                                    Delete Review
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
        // Fallback: copy to clipboard
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