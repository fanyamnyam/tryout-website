<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user diperbolehkan membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk input login.
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'], 
            'password' => ['required', 'string'],
            'role'     => ['required', 'string'], 
        ];
    }

    /**
     * Proses autentikasi kredensial.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('username', 'password');
        $role = $this->input('role');

        /**
         * NORMALISASI ROLE
         * Menyamakan input dari form ('ortu') dengan isi kolom di database ('orang_tua').
         * Tanpa ini, pencarian Auth::attempt akan gagal karena teks tidak cocok.
         */
        if ($role === 'ortu') {
            $role = 'orang_tua';
        }

        /**
         * AUTH ATTEMPT (STRICT MATCHING)
         * Laravel akan menjalankan query: 
         * SELECT * FROM users WHERE username = ? AND role = ?
         * Lalu memverifikasi password-nya.
         */
        if (! Auth::attempt(array_merge($credentials, ['role' => $role]), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => 'Login gagal! Username, password, atau role tidak sesuai dengan data kami.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Memastikan request tidak melebihi batas percobaan (Rate Limiting).
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Membuat kunci unik untuk pembatasan login.
     * Kita tambahkan 'role' agar jika satu role terkunci, role lain 
     * dengan username yang sama tetap bisa mencoba login.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('username')).'|'.$this->input('role').'|'.$this->ip());
    }
}