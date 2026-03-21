<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Orders';

    protected $primaryKey = 'OrderID';

    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'OrderDate',
        'OrderStatus',
        'TotalAmount',
        'Address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'OrderID');
    }
}
