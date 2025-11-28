<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Category';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;

    protected $fillable = ['CategoryName'];

    public function products()
    {
        return $this->hasMany(Product::class, 'CategoryID');
    }
}
