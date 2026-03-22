<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingSize extends Model
{
    protected $table = 'Ring_Size';

    protected $primaryKey = null;
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ProductID',
        'Size',
        'Stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
