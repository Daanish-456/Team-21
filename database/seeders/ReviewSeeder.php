<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('Reviews')->insert([
            [
                'UserID' => 1,
                'ProductID' => 1,
                'Rating' => 5,
                'Comment' => 'Lovely everyday necklace with a delicate finish. It looks even better in person.',
                'ReviewDate' => now()->subDays(14),
            ],
            [
                'UserID' => 3,
                'ProductID' => 1,
                'Rating' => 4,
                'Comment' => 'Nice quality and lightweight to wear. The chain could be a little longer for layering.',
                'ReviewDate' => now()->subDays(10),
            ],
            [
                'UserID' => 1,
                'ProductID' => 4,
                'Rating' => 5,
                'Comment' => 'The gemstone colours are beautiful and the bracelet feels well made.',
                'ReviewDate' => now()->subDays(7),
            ],
            [
                'UserID' => 4,
                'ProductID' => 2,
                'Rating' => 5,
                'Comment' => 'Elegant and minimal without feeling plain. It layers really well with other necklaces.',
                'ReviewDate' => now()->subDays(9),
            ],
            [
                'UserID' => 1,
                'ProductID' => 3,
                'Rating' => 4,
                'Comment' => 'The pendant has a nice weight and texture. It feels like a good statement piece.',
                'ReviewDate' => now()->subDays(8),
            ],
            [
                'UserID' => 3,
                'ProductID' => 5,
                'Rating' => 4,
                'Comment' => 'Comfortable bracelet with a subtle shine. I have been wearing it most days.',
                'ReviewDate' => now()->subDays(6),
            ],
            [
                'UserID' => 2,
                'ProductID' => 6,
                'Rating' => 4,
                'Comment' => 'Simple design but it looks polished on the wrist. Easy to match with other jewellery.',
                'ReviewDate' => now()->subDays(6),
            ],
            [
                'UserID' => 4,
                'ProductID' => 7,
                'Rating' => 4,
                'Comment' => 'Simple ring with a clean finish. Good for stacking with other pieces.',
                'ReviewDate' => now()->subDays(5),
            ],
            [
                'UserID' => 1,
                'ProductID' => 8,
                'Rating' => 5,
                'Comment' => 'The gemstone setting is really pretty and the ring feels secure and comfortable.',
                'ReviewDate' => now()->subDays(4),
            ],
            [
                'UserID' => 3,
                'ProductID' => 9,
                'Rating' => 4,
                'Comment' => 'Modern shape and a good solid feel. It looks exactly like the product photos.',
                'ReviewDate' => now()->subDays(3),
            ],
            [
                'UserID' => 4,
                'ProductID' => 10,
                'Rating' => 4,
                'Comment' => 'Lovely bracelet design and it still looks good after regular wear.',
                'ReviewDate' => now()->subDays(3),
            ],
            [
                'UserID' => 3,
                'ProductID' => 11,
                'Rating' => 5,
                'Comment' => 'Bought these for an occasion and they were comfortable all evening.',
                'ReviewDate' => now()->subDays(2),
            ],
        ]);
    }
}
