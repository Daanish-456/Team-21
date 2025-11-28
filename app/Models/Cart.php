<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'Cart';
    protected $primaryKey = 'CartID';
    public $timestamps = false;

    protected $fillable = ['UserID'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'CartID');
    }
}
