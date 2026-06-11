<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Buat akun admin default.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ananda.com'],
            [
                'name' => 'Admin Ananda',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
