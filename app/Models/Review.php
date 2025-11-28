<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'Review';
    protected $primaryKey = 'ReviewID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'ProductID',
        'Rating',
        'Comment',
        'ReviewDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
