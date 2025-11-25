<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class FoursquareService
{
    protected $key;
    public function __construct()
    {
        $this->key = config('services.foursquare.key');
    }

    // search places
    public function search(string $query, string $near = 'Jakarta', int $limit = 10)
    {
        $res = Http::withHeaders([
            'Authorization' => $this->key,
            'Accept' => 'application/json',
        ])->get('https://api.foursquare.com/v3/places/search', [
            'query' => $query,
            'near' => $near,
            'limit' => $limit,
        ]);

        return $res->ok() ? $res->json() : null;
    }

    // details
    public function details(string $fsq_id)
    {
        $res = Http::withHeaders([
            'Authorization' => $this->key,
            'Accept' => 'application/json',
        ])->get("https://api.foursquare.com/v3/places/{$fsq_id}");
        return $res->ok() ? $res->json() : null;
    }

    // photos
    public function photos(string $fsq_id, int $limit = 5)
    {
        $res = Http::withHeaders([
            'Authorization' => $this->key,
            'Accept' => 'application/json',
        ])->get("https://api.foursquare.com/v3/places/{$fsq_id}/photos", [
            'limit' => $limit
        ]);
        return $res->ok() ? $res->json() : null;
    }

    // helper: build first photo url (original)
    public function firstPhotoUrl(array $photos = null)
    {
        if (empty($photos) || !is_array($photos)) return null;
        $p = $photos[0] ?? null;
        return $p ? ($p['prefix'] . 'original' . $p['suffix']) : null;
    }

    // helper: normalize hours / opening display
    public function parseOpeningHours(array $detail = null)
    {
        if (empty($detail)) return null;
        if (isset($detail['hours'])) {
            return $detail['hours'];
        }
        return null;
    }
}
