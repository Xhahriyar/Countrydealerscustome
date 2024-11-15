<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database. User::create

     */
    public function run(): void
    {
        User::create([
            'fist_name' => 'super',
            'last_name' => 'admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
        ]);
    }
}
