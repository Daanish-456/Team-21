<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            [
                'Name'      => 'Zainab Mazahir',
                'Email'     => 'zainab@example.com',
                'Password'  => Hash::make('password123'),
                'Phone'     => '07123456789',
                'Addresss'   => '123 Aston Road, Birmingham',
                'Role'      => 'customer',
            ],
            [
                'Name'      => 'Admin User',
                'Email'     => 'admin@example.com',
                'Password'  => Hash::make('admin123'),
                'Phone'     => '07000000000',
                'Addresss'   => 'Admin Street',
                'Role'      => 'admin',
            ]
        ]);
    }
}
