<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar favorites
    public function index()
    {
        $favorites = Auth::user()->favoritePlaces()->paginate(12);
        return view('page.favorites', compact('favorites'));
    }

    // Toggle favorite (add/remove)
    public function toggle(Request $request, $placeId)
    {
        $user = Auth::user();
        $place = Place::findOrFail($placeId);

        $favorite = Favorite::where('user_id', $user->id)
                           ->where('place_id', $placeId)
                           ->first();

        if ($favorite) {
            // Hapus dari favorite
            $favorite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Dihapus dari favorit'
            ]);
        } else {
            // Tambahkan ke favorite
            Favorite::create([
                'user_id' => $user->id,
                'place_id' => $placeId
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Ditambahkan ke favorit'
            ]);
        }
    }

    // Check if place is favorited
    public function check($placeId)
    {
        $isFavorited = Favorite::where('user_id', Auth::id())
                              ->where('place_id', $placeId)
                              ->exists();

        return response()->json(['is_favorited' => $isFavorited]);
    }
}
