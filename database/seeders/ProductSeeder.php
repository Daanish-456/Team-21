<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            [
                'Product_Name' => 'Rose Gold Necklace',
                'Description' => 'Elegant rose gold necklace with a minimalistic pendant.',
                'Price' => 49.99,
                'Stock' => 15,
                'Image_URL' => 'assets/images/products/necklace1.jpg',
                'CategoryID' => 1
            ],
            [
                'Product_Name' => 'Diamond Stud Earrings',
                'Description' => 'Classic diamond stud earrings perfect for daily wear.',
                'Price' => 79.99,
                'Stock' => 10,
                'Image_URL' => 'assets/images/products/earrings1.jpg',
                'CategoryID' => 2
            ],
            [
                'Product_Name' => 'Sterling Silver Bracelet',
                'Description' => 'Handcrafted sterling silver bracelet with intricate design.',
                'Price' => 35.50,
                'Stock' => 20,
                'Image_URL' => 'assets/images/products/bracelet1.jpg',
                'CategoryID' => 3
            ],
            [
                'Product_Name' => 'Gold Plated Ring',
                'Description' => 'Adjustable gold plated ring with gemstone centerpiece.',
                'Price' => 29.99,
                'Stock' => 25,
                'Image_URL' => 'assets/images/products/ring1.jpg',
                'CategoryID' => 4
            ],
            [
                'Product_Name' => 'Pearl Drop Earrings',
                'Description' => 'Elegant pearl drop earrings for special occasions.',
                'Price' => 55.00,
                'Stock' => 12,
                'Image_URL' => 'assets/images/products/earrings2.jpg',
                'CategoryID' => 2
            ]
        ]);
    }
}
