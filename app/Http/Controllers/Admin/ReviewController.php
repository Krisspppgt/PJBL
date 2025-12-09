<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Place;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of reviews
     */
    public function index(Request $request)
    {
        $query = Review::with(['user', 'place']);

        // Filter by search (user name or place name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('place', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })
                ->orWhere('comment', 'like', "%{$search}%");
            });
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by place
        if ($request->filled('place_id')) {
            $query->where('place_id', $request->place_id);
        }

        $reviews = $query->latest()->paginate(15)->withQueryString();
        $places = Place::orderBy('name')->get(['id', 'name']);

        return view('admin.reviews.index', compact('reviews', 'places'));
    }

    /**
     * Show the form for editing the specified review
     */
    public function edit(Review $review)
    {
        $review->load(['user', 'place']);
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified review
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $review->update($validated);

        // Update place average rating
        $review->place->updateAverageRating();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil diperbarui.');
    }

    /**
     * Remove the specified review
     */
    public function destroy(Review $review)
    {
        $place = $review->place;
        $review->delete();

        // Update place average rating
        $place->updateAverageRating();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}
