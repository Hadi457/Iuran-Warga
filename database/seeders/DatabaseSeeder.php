<?php

namespace Database\Seeders;

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
<<<<<<< HEAD
            'name' => 'member User',
            'username' => 'member',
=======
            'name' => 'Warga User',
            'alamat' => 'Jl. Contoh No. 123',
            'no_telepon' => '08123456789',
            'username' => 'warga',
>>>>>>> 609b12bcc7e7308e8532eb03ad72d652b2d63d94
            'password' => bcrypt('warga123'),
            'level' => 'Warga',
        ]);
    }
}
