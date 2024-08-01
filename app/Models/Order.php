<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'wisata_id', 'quantity', 'visit_date', 'status', 'total_price'];

    use HasFactory;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // Relasi dengan Wisata
    public function wisata(): BelongsTo
    {
        return $this->belongsTo(Wisata::class);
    }
    public function review(){
        return $this->hasMany(Ulasan::class);
    }
}
