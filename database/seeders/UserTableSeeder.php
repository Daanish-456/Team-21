<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Users')->insert([
            [
                'Name' => 'John Smith',
                'Email' => 'johnsmith@example.com',
                'Password' => Hash::make('password123'),
                'Phone' => '07123456789',
                'Address' => '',
                'Role' => 'customer',
            ],
            [
                'Name' => 'Admin',
                'Email' => 'admin@stoneandsoul.com',
                'Password' => Hash::make('admin123'),
                'Phone' => '07000000000',
                'Address' => 'Admin Street',
                'Role' => 'admin',
            ],
            [
                'Name' => 'Emily Carter',
                'Email' => 'emily.carter@example.com',
                'Password' => Hash::make('password123'),
                'Phone' => '07222333444',
                'Address' => '18 Oak Avenue, Bristol',
                'Role' => 'customer',
            ],
            [
                'Name' => 'Daniel Hughes',
                'Email' => 'daniel.hughes@example.com',
                'Password' => Hash::make('password123'),
                'Phone' => '07333444555',
                'Address' => '44 King Street, York',
                'Role' => 'customer',
            ],
        ]);
    }
}
