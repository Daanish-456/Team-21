<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RingSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Ring_Size')->delete();

        $ringProductIds = Product::query()
            ->where('CategoryID', 4)
            ->orderBy('ProductID')
            ->pluck('ProductID');

        $sizes = range('G', 'Z');
        $ringSizes = [];

        foreach ($ringProductIds as $productId) {
            foreach ($sizes as $size) {
                $ringSizes[] = [
                    'ProductID' => $productId,
                    'Size' => $size,
                    'Stock' => 5,
                ];
            }
        }

        DB::table('Ring_Size')->insert($ringSizes);
    }
}
