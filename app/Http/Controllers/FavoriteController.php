<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        try {
            $user = Auth::user();

            // Log untuk debugging
            Log::info('Toggle favorite request', [
                'user_id' => $user->id,
                'place_id' => $placeId
            ]);

            $place = Place::findOrFail($placeId);

            $favorite = Favorite::where('user_id', $user->id)
                               ->where('place_id', $placeId)
                               ->first();

            if ($favorite) {
                // Hapus dari favorite
                $favorite->delete();

                Log::info('Removed from favorites', ['place_id' => $placeId]);

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

                Log::info('Added to favorites', ['place_id' => $placeId]);

                return response()->json([
                    'status' => 'added',
                    'message' => 'Ditambahkan ke favorit!'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error toggling favorite', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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
