<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');

        // Sama seperti GuestController, tapi tanpa view "guest"
        $query = Place::with('user');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $places = $query->latest()->paginate(6);

        return view('page.homepage', compact('places', 'category'));
    }
}
