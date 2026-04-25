<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 
        'username', 
        'password', 
        'password_plain', 
        'role', 
        'gender', 
        'class',
        'student_nisn', // INI WAJIB ADA supaya data NISN anak bisa tersimpan
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi untuk menghubungkan Orang Tua ke Siswa
     */
    public function student()
    {
        // Relasi ini mencari User (siswa) yang 'username'-nya sama dengan 'student_nisn' milik ortu
        return $this->belongsTo(User::class, 'student_nisn', 'username');
    }
}