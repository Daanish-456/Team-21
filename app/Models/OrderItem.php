<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'Order_Item';
    public $timestamps = false;

    // composite primary key (OrderID, ProductID)
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'OrderID',
        'ProductID',
        'Quantity',
        'Price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
