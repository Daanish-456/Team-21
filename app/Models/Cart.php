<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'Cart';
    protected $primaryKey = 'CartID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'CreatedAt',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'CartID');
    }
}

