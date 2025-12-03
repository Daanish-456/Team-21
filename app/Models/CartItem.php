<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'Cart_Item';

    protected $primaryKey = null;
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'CartID',
        'ProductID',
        'Quantity',
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class, 'CartID');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
