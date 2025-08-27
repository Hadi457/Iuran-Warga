<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'level' => 'Admin',
        ]);
        User::create([
            'name' => 'Admin User 2',
            'username' => 'adminz',
            'password' => bcrypt('admin123'),
            'level' => 'Admin',
        ]);
        Member::create([
            'nik' => '1234567890123456',
            'name' => 'Hadi',
            'addres' => '123 Main St',
            'number_handphone' => '555-1234',
            'users_id' => 1,
        ]);
        Member::create([
            'nik' => '3216549870123456',
            'name' => 'Fariz',
            'addres' => '456 Elm St',
            'number_handphone' => '555-5678',
            'users_id' => 2,
        ]);
    }
}
