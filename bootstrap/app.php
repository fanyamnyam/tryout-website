<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Daftarkan Alias Middleware Role
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // 2. Atur Redirect Otomatis
        $middleware->redirectTo(
            // Jika belum login (guest) dan mencoba akses page terproteksi
            guests: '/pilih-role', 

            // Jika SUDAH login tapi mencoba akses page login/guest lagi
            users: function () {
                $user = auth()->user();

                if (!$user) {
                    return route('landing');
                }

                // Logika "pintu pulang" otomatis agar tidak nyasar
                return match ($user->role) {
                    'admin'             => route('admin.dashboard'),
                    'guru'              => route('guru.dashboard'),
                    'siswa'             => route('siswa.dashboard'),
                    'orang_tua', 'ortu' => route('ortu.dashboard'),
                    default             => route('landing'),
                };
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();