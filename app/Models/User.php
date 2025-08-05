<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // User has many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // User has one cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // User has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // User has many wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->email == 'admin@gmail.com';
    // }
}
