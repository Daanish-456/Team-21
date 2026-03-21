<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        DB::table('Wishlist')->insert([
            [
                'WishlistID' => 1,
                'UserID' => 1,
            ],
            [
                'WishlistID' => 2,
                'UserID' => 2,
            ],
        ]);

        DB::table('Wishlist_Item')->insert([
            [
                'WishlistID' => 1,
                'ProductID' => 3,
            ],
            [
                'WishlistID' => 1,
                'ProductID' => 8,
            ],
            [
                'WishlistID' => 1,
                'ProductID' => 9,
            ],
            [
                'WishlistID' => 2,
                'ProductID' => 1,
            ],
            [
                'WishlistID' => 2,
                'ProductID' => 6,
            ],
        ]);
    }
}
