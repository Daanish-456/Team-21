<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    protected $table = 'Wishlist_Item';

    protected $primaryKey = null;
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'WishlistID',
        'ProductID',
    ];

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'WishlistID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
