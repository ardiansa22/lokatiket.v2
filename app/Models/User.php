<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

  
class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
  
    use HasRoles, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    use HasRoles;
    public function vendor()
{
    return $this->hasOne(Vendor::class);
}
public function orders(): HasMany
{
    return $this->hasMany(Order::class);
}
public function ulasans(): HasMany
    {
        return $this->hasMany(Ulasan::class);
    }

    public function wisatas()
    {
        return $this->hasMany(Wisata::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function wishlist()
{
    return $this->belongsToMany(Wisata::class, 'whislists', 'user_id', 'wisata_id')->withTimestamps();
}


}