<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTicketSeeder extends Seeder
{
    public function run()
    {
        DB::table('Contact_Message')->insert([
            [
                'name' => 'John Smith',
                'email' => 'johnsmith@example.com',
                'message' => 'Hi, I placed an order for the Luna Moon Pendant and wanted to check when it is expected to be dispatched.',
                'UserID' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'name' => 'Mia Carter',
                'email' => 'mia.carter@example.com',
                'message' => 'Could you confirm whether the Solace Gemstone Ring is available in a size M before I place my order?',
                'UserID' => null,
                'created_at' => now()->subDays(2)->subHours(4),
                'updated_at' => now()->subDays(2)->subHours(4),
            ],
            [
                'name' => 'Daniel Hughes',
                'email' => 'daniel.hughes@example.com',
                'message' => 'My bracelet arrived today, but I think I selected the wrong size. Please let me know the return or exchange steps.',
                'UserID' => null,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@stoneandsoul.com',
                'message' => 'Test contact ticket for reviewing the admin dashboard layout and ticket list rendering.',
                'UserID' => 2,
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
        ]);
    }
}
