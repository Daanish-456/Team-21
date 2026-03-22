<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('Product')->insert([
            [
                'Product_Name' => 'Luna Moon Pendant',
                'Description' => 'Delicate moon pendant on a fine gold-plated chain, perfect for everyday layering.',
                'Price' => 45.00,
                'Stock' => 2,
                'Image_URL' => 'assets/images/products/necklaces/luna-moon.png',
                'Metal' => 'Gold',
                'CategoryID' => 1,
            ],
            [
                'Product_Name' => 'Soulstone Bar Necklace',
                'Description' => 'A minimalist bar necklace set with a single ethically-sourced crystal.',
                'Price' => 52.00,
                'Stock' => 12,
                'Image_URL' => 'assets/images/products/necklaces/soulstone-bar.png',
                'Metal' => 'Gold',
                'CategoryID' => 1,
            ],
            [
                'Product_Name' => 'Aura Coin Necklace',
                'Description' => 'Hand-hammered coin pendant symbolising protection and clarity.',
                'Price' => 60.00,
                'Stock' => 12,
                'Image_URL' => 'assets/images/products/necklaces/aura-coin.jpg',
                'Metal' => 'Rose Gold',
                'CategoryID' => 1,
            ],

            [
                'Product_Name' => 'Harmony Bead Bracelet',
                'Description' => 'Hand-strung gemstones chosen to promote balance and calm.',
                'Price' => 35.00,
                'Stock' => 12,
                'Image_URL' => 'assets/images/products/bracelets/harmony-bead.png',
                'Metal' => 'Gold',
                'CategoryID' => 3,
            ],
            [
                'Product_Name' => 'Serenity Chain Bracelet',
                'Description' => 'Fine chain bracelet with subtle textured links for a soft shimmer.',
                'Price' => 40.00,
                'Stock' => 17,
                'Image_URL' => 'assets/images/products/bracelets/serenity-chain.png',
                'Metal' => 'Gold',
                'CategoryID' => 3,
            ],
            [
                'Product_Name' => 'Soul Cuff',
                'Description' => 'Adjustable cuff bracelet with a softly brushed finish.',
                'Price' => 40.00,
                'Stock' => 17,
                'Image_URL' => 'assets/images/products/bracelets/soul-cuff.png',
                'Metal' => 'Gold',
                'CategoryID' => 3,
            ],

            [
                'Product_Name' => 'Eclipse Stacking Ring',
                'Description' => 'Slim band finished with a subtle hammered texture, perfect for stacking.',
                'Price' => 29.99,
                'Stock' => 4,
                'Metal' => 'Gold',
                'Image_URL' => 'assets/images/products/rings/eclipse-stack.jpg',
                'CategoryID' => 4,
            ],
            [
                'Product_Name' => 'Solace Gemstone Ring',
                'Description' => 'Single gemstone ring in a classic claw setting.',
                'Price' => 55.75,
                'Stock' => 12,
                'Metal' => 'Gold',
                'Image_URL' => 'assets/images/products/rings/solace-gemstone.png',
                'CategoryID' => 4,
            ],
            [
                'Product_Name' => 'Orbit Signet Ring',
                'Description' => 'A modern signet ring with softly rounded edges.',
                'Price' => 55.75,
                'Stock' => 11,
                'Metal' => 'Gold',
                'Image_URL' => 'assets/images/products/rings/orbit-signet.jpg',
                'CategoryID' => 4,
            ],

            [
                'Product_Name' => 'Sterling Silver Bracelet',
                'Description' => 'Handcrafted sterling silver bracelet with intricate design.',
                'Price' => 35.50,
                'Stock' => 0,
                'Metal' => 'Silver',
                'Image_URL' => 'assets/images/products/bracelet1.jpg',
                'CategoryID' => 3,
            ],
            [
                'Product_Name' => 'Pearl Drop Earrings',
                'Description' => 'Elegant pearl drop earrings for special occasions.',
                'Price' => 55.00,
                'Stock' => 12,
                'Metal' => 'Silver',
                'Image_URL' => 'assets/images/products/earrings2.jpg',
                'CategoryID' => 2,
            ],
        ]);
    }
}
