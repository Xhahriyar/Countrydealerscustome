<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'fist_name' => 'super',
            'last_name' => 'admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
        ]);
    }
}
