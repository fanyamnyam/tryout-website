<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  (Variadic parameter untuk menerima banyak role sekaligus)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('landing')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Ambil role user yang sedang aktif
        $userRole = Auth::user()->role;

        /**
         * 3. VERIFIKASI ROLE
         * Kita cek apakah role user ada di dalam daftar $roles yang diizinkan di web.php.
         * Contoh: middleware(['role:admin,guru']) akan mengecek apakah user itu admin ATAU guru.
         */
        if (!in_array($userRole, $roles)) {
            
            /**
             * TINDAKAN TEGAS:
             * Jika role tidak cocok, kita paksa LOGOUT. 
             * Ini untuk mencegah "session leakage" (kebocoran sesi) 
             * yang bikin Admin nyasar ke Ortu tadi.
             */
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('landing')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }

        // Jika lolos verifikasi, izinkan masuk ke halaman berikutnya
        return $next($request);
    }
}