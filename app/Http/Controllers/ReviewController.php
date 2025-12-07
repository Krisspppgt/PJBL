<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Check if user already reviewed this place
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('place_id', $place->id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this place. You can delete your previous review to write a new one.');
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

        return back()->with('success', 'Thank you for your review!');
    }

    /**
     * Delete a review
     */
    public function destroy(Review $review)
    {
        // Check if user owns this review
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'You can only delete your own reviews.');
        }

        $place = $review->place;
        
        // Delete the review
        $review->delete();

        // Update place average rating
        $place->updateAverageRating();

        return back()->with('success', 'Review deleted successfully.');
    }

    /**
     * Update a review (optional - for edit functionality)
     */
    public function update(Request $request, Review $review)
    {
        // Check if user owns this review
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'You can only edit your own reviews.');
        }

        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        // Update review
        $review->update($validated);

        // Update place average rating
        $review->place->updateAverageRating();

        return back()->with('success', 'Review updated successfully.');
    }
}