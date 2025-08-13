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
            'name' => 'Warga User',
            'username' => 'warga',
            'password' => bcrypt('warga123'),
            'level' => 'Warga',
        ]);
        User::create([
            'name' => 'Warga Dua',
            'username' => 'wagakita',
            'password' => bcrypt('wargakita'),
            'level' => 'Warga',
        ]);
        Member::create([
            'nik' => '1234567890123456',
            'name' => 'Warga Satu',
            'addres' => 'Jl. Contoh No. 1',
            'number_handphone' => '081234567890',
            'users_id' => 2,
            'image' => null,
        ]);
        Member::create([
            'nik' => '6543210987654321',
            'name' => 'Warga Dua',
            'addres' => 'Jl. Contoh No. 2',
            'number_handphone' => '089876543210',
            'users_id' => 3,
            'image' => null,
        ]);
    }
}
