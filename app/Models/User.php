<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'User';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

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

    public function getAuthIdentifierName()
    {
        return 'Email';
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}