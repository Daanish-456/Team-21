<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Category')->insert([
            [
                'CategoryID' => '1',
                'CategoryName' => 'Necklace',
            ],
            [
                'CategoryID' => '2',
                'CategoryName' => 'Earrings',
            ],
            [
                'CategoryID' => '3',
                'CategoryName' => 'Bracelets',
            ],
            [
                'CategoryID' => '4',
                'CategoryName' => 'Rings',
            ],
        ]);
    }
}
