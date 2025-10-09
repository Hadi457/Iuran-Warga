<?php

namespace Database\Seeders;

use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Member;
use App\Models\Officer;
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
        DuesCategory::create([
            'period' => 'bulanan',
            'nominal' => '100000'
        ]);
        DuesCategory::create([
            'period' => 'mingguan',
            'nominal' => '50000'
        ]);
        DuesCategory::create([
            'period' => 'tahunan',
            'nominal' => '1000000'
        ]);
        Member::create([
            'nik' => '1234567890123456',
            'name' => 'Hadi',
            'addres' => '123 Main St',
            'number_handphone' => '555-1234',
            'dues_category_id' => 2,
            'users_id' => 1,
        ]);
        Member::create([
            'nik' => '3216549870123456',
            'name' => 'Fariz',
            'addres' => '456 Elm St',
            'number_handphone' => '555-5678',
            'dues_category_id' => 1,
            'users_id' => 2,
        ]);
        DuesMember::create([
            'iduser' => 1,
            'dues_category_id' => 2,
        ]);
        DuesMember::create([
            'iduser' => 2,
            'dues_category_id' => 1,
        ]);
        Officer::create([
            'iduser' => 1
        ]);
        Officer::create([
            'iduser' => 2
        ]);

    }
}
