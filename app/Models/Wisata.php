<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = ['user_id','name', 'description', 'price', 'kategori', 'facilities', 'images'];

    protected $casts = [
        'images' => 'array',
    ];
    use HasFactory;
    // Relasi One to Many
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ulasans()->avg('rating');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Method to format average rating text
    public function getRatingTextAttribute()
    {
        $averageRating = $this->average_rating;
        if ($averageRating === null) {
            return 'Belum ada ulasan';
        }
        return number_format($averageRating, 1);
    }
}
