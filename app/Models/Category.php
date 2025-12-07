<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

     protected $table = 'kategori';

    protected $fillable = ['name', 'slug'];

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
