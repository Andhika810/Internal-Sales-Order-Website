<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@caturmala.com'], // kunci unik
            [
                'name' => 'Admin PT Caturmala',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'address' => 'Kantor PT Caturmala',
                'phone' => '081234567890',
            ]
        );
    }
}