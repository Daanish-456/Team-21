<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    protected $fillable = [
        'Product_Name',
        'Description',
        'Price',
        'Stock',
        'Image_URL',
        'CategoryID',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ProductID');
    }
}
