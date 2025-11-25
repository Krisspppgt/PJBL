<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'address',
        'latitude',
        'longitude',
        'image',
        'rating',
        'reviews_count',
        'tags',
        'phone',
        'opening_hours',
        'price_range',
        'foursquare_id',
        'user_id',
    ];

    protected $casts = [
        'rating' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
        'opening_hours' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
