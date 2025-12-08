<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'description',
        'address',
        'district',
        'rating',
        'reviews_count',
        'phone',
        'instagram',
        'opening_hours',
        'image',
        
        'image_url',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
    ];

    /**
     * Get all reviews for this place
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    /**
     * Get users who favorited this place
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'place_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Calculate and update average rating
     */
    public function updateAverageRating()
    {
        $avgRating = $this->reviews()->avg('rating');
        $reviewCount = $this->reviews()->count();
        
        $this->update([
            'rating' => $avgRating ? round($avgRating, 1) : 0,
            'reviews_count' => $reviewCount,
        ]);
    }

    /**
     * Scope untuk filter by category
     */
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope untuk filter by district
     */
    public function scopeByDistrict($query, $district)
    {
        if ($district) {
            return $query->where('district', $district);
        }
        return $query;
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}