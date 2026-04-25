<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(Request $request): View
    {
        // Mengambil role dari URL (misal: /login/admin)
        $role = $request->route('role'); 
        return view('auth.login', compact('role'));
    }

    /**
     * Proses Login (Store Session).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. PROTEKSI: Jika ada orang yang sudah login, paksa logout dulu
        // Ini kunci agar session Admin tidak nyangkut saat kamu tes login Siswa.
        if (Auth::check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // 2. Jalankan validasi ketat (Username + Pass + Role) di LoginRequest
        $request->authenticate();

        // 3. Jika lolos, buat session baru
        $request->session()->regenerate();

        $user = Auth::user();

        // 4. REDIRECT KAKU: Arahkan langsung ke rute dashboard masing-masing
        // Kita tidak pakai intended() agar tidak diarahkan ke halaman "memori" lama.
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } 
        
        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        } 
        
        if ($user->role === 'orang_tua' || $user->role === 'ortu') {
            return redirect()->route('ortu.dashboard');
        }

        // 5. FAILSAFE: Jika role tidak dikenali, paksa logout
        Auth::logout();
        return redirect()->route('landing')->with('error', 'Role pengguna tidak valid.');
    }

    /**
     * Proses Logout (Destroy Session).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Kembali ke halaman pilih role
        return redirect()->route('landing');
    }
}