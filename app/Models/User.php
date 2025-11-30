<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'User';
    protected $primaryKey = 'UserID';
    public $timestamps = false; // no created_at/updated_at

    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'Phone',
        'Address',
        'Role',
    ];

    protected $hidden = ['Password'];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'UserID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'UserID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'UserID');
    }
}
