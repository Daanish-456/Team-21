<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;

class User extends Authenticatable
{
    use Notifiable;

    // Table name and primary key
    protected $table = 'User';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'Phone',
        'Address',
        'Role',
    ];

    // Hidden fields (won't appear in arrays or JSON)
    protected $hidden = [
        'Password',
    ];

    // Relationships
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

    // Authentication methods
    public function getAuthIdentifierName()
    {
        return 'Email'; // Login field
    }

    public function getAuthPassword()
    {
        return $this->Password; // Password field
    }
}
