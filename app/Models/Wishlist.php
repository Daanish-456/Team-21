<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'Wishlist';
    protected $primaryKey = 'WishlistID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
    ];

    public function items()
    {
        return $this->hasMany(WishlistItem::class, 'WishlistID');
    }
}
