<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'superadmin@admin.com',
            'password' => base64_encode('12345678'),
            'is_admin' => 1,
        ]);
    }
}
