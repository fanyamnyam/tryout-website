<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin', // Ini yang akan diketik di login
            'password' => Hash::make('admin123'), // Passwordnya: admin123
            'role' => 'admin',
        ]);
        
        // Kamu juga bisa sekalian bikin akun guru buat ngetes
        User::create([
            'name' => 'Pak Guru SDIT',
            'username' => 'guru01',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);
    }
}