<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\BadWordsFilter;

class ReviewController extends Controller
{
    /**
     * Constructor - require authentication
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new review
     */
    public function store(Request $request, Place $place)
    {
        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ], [
            'rating.required' => 'Please select a rating',
            'rating.min' => 'Rating must be at least 1 star',
            'rating.max' => 'Rating cannot exceed 5 stars',
            'comment.required' => 'Please write a comment',
            'comment.min' => 'Comment must be at least 10 characters',
            'comment.max' => 'Comment cannot exceed 1000 characters',
        ]);

        // Check for bad words
        if (BadWordsFilter::containsBadWords($validated['comment'])) {
            return back()->withErrors([
                'comment' => 'Jangan berkata kasar ya bang'
            ])->withInput();
        }

        // Check if user already reviewed this place
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('place_id', $place->id)
                                ->first();

        if ($existingReview) {
            return back()->with('error','Anda sudah memberikan ulasan');
        }

        // Create review
        $review = Review::create([
            'user_id' => Auth::id(),
            'place_id' => $place->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // Update place average rating
        $place->updateAverageRating();

        return back()->with('success', 'Terima kasih telah memberikan ulasan');
    }

    /**
     * Delete a review
     */
    public function destroy(Review $review)
    {
        // Check if user owns this review
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Kamu hanya bisa menghapus ulasan milikmu sendiri.');
        }

        $place = $review->place;
        
        // Delete the review
        $review->delete();

        // Update place average rating
        $place->updateAverageRating();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }

    /**
     * Update a review
     */
    public function update(Request $request, Review $review)
    {
        // Check if user owns this review
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Kamu hanya bisa mengedit ulasan milikmu sendiri.');
        }

        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        // Check for bad words
        if (BadWordsFilter::containsBadWords($validated['comment'])) {
            return back()->withErrors([
                'comment' => 'Jangan berkata kasar ya bang'
            ])->withInput();
        }

        // Update review
        $review->update($validated);

        // Update place average rating
        $review->place->updateAverageRating();

        return back()->with('success', 'Ulasan berhasil diperbarui.');
    }
}