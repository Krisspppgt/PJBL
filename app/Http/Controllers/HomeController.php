<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Constructor - require authentication
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display homepage with places list
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

        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Order by rating and paginate
        $places = $query->orderBy('rating', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->paginate(12)
                       ->withQueryString();

        return view('page.homepage', compact('places', 'category'));
    }

    /**
     * Display the specified place with reviews
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

        return view('page.place_detail', compact('place', 'reviews'));
    }
}
