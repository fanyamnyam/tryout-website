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
        \App\Models\User::create([
            'name' => 'Syafira Fanya',
            'username' => 'admin01',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'password_plain' => 'admin123',
            'role' => 'admin',
            'gender' => 'P',
            'class' => 'Admin Utama',
        ]);
    }
}
