<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display guest homepage with places list
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search');
        $district = $request->get('district');

        $query = Place::query();

        // Filter by category
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        // Filter by district
        if ($district) {
            $query->where('district', $district);
        }

        // Search functionality - Now includes district search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%"); // Added district search
            });
        }

        // Order by rating and paginate
        $places = $query->orderBy('rating', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->paginate(12)
                       ->withQueryString();

        // Get list of districts for filter
        $districts = Place::select('district')
                         ->distinct()
                         ->whereNotNull('district')
                         ->orderBy('district')
                         ->pluck('district');

        return view('guest.home', compact('places', 'category', 'districts'));
    }

    /**
     * Display the specified place (guest view - read only, no review form)
     */
    public function show($id)
    {
        // Get place with reviews (paginated)
        $place = Place::findOrFail($id);

        // Get reviews with user info, paginated (10 per page)
        $reviews = $place->reviews()
                        ->with('user')
                        ->latest()
                        ->paginate(10);

        // Guest akan melihat view yang sama tapi tanpa form review
        return view('page.place_detail', compact('place', 'reviews'));
    }
}
