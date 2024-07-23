<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = [
        'user_id', 'wisata_id','order_id', 'rating', 'komentar',
    ];

    // Relasi dengan model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Wisata
    public function wisata(): BelongsTo
    {
        return $this->belongsTo(Wisata::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
