<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('Orders')->insert([
            [
                'OrderID' => 1,
                'UserID' => 1,
                'OrderDate' => Date::now(),
                'OrderStatus' => 'Pending',
                'TotalAmount' => 97.00,
            ],
            [
                'OrderID' => 2,
                'UserID' => 1,
                'OrderDate' => Date::now(),
                'OrderStatus' => 'Processing',
                'TotalAmount' => 115.75,
            ],
            [
                'OrderID' => 3,
                'UserID' => 1,
                'OrderDate' => Date::now(),
                'OrderStatus' => 'Completed',
                'TotalAmount' => 130.00,
            ],
        ]);

        DB::table('Order_Item')->insert([
            [
                'OrderID' => 1,
                'ProductID' => 1,
                'Quantity' => 1,
                'Price' => 45.00,
            ],
            [
                'OrderID' => 1,
                'ProductID' => 2,
                'Quantity' => 1,
                'Price' => 52.00,
            ],
            [
                'OrderID' => 2,
                'ProductID' => 3,
                'Quantity' => 1,
                'Price' => 60.00,
            ],
            [
                'OrderID' => 2,
                'ProductID' => 8,
                'Quantity' => 1,
                'Price' => 55.75,
            ],
            [
                'OrderID' => 3,
                'ProductID' => 4,
                'Quantity' => 1,
                'Price' => 35.00,
            ],
            [
                'OrderID' => 3,
                'ProductID' => 5,
                'Quantity' => 1,
                'Price' => 40.00,
            ],
            [
                'OrderID' => 3,
                'ProductID' => 11,
                'Quantity' => 1,
                'Price' => 55.00,
            ],
        ]);
    }
}
