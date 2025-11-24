<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');

        $query = Place::with('user');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $places = $query->latest()->paginate(6);

        return view('guest.home', compact('places', 'category'));
    }

    public function show($id)
    {
        $place = Place::with('user')->findOrFail($id);
        return view('guest.detail', compact('place'));
    }
}
