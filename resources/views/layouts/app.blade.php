<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SDIT Al Iman') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <script src="https://unpkg.com/@phosphor-icons/web"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { 
                font-family: 'Inter', sans-serif; 
                background-color: #F8FAFC; 
            }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    {{-- Inisialisasi x-data di body agar bisa diakses dari Sidebar --}}
    <body class="antialiased text-slate-900" x-data="{ openLogoutModal: false }">
        
        <div class="flex min-h-screen bg-[#F8FAFC]">
            
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                
                @isset($header)
                    <header class="bg-[#FDFDFF] border-b border-slate-200 shadow-sm">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <main class="flex-1 overflow-y-auto p-6 md:p-10">
                    {{ $slot }}
                </main>
                
            </div>
        </div>

        {{-- ==========================================================
             MODAL LOGOUT (SESUAI DESAIN GAMBAR)
             ========================================================== --}}
        <div x-show="openLogoutModal" 
             class="fixed inset-0 z-[150] flex items-center justify-center bg-black/50 backdrop-blur-sm" 
             x-transition 
             x-cloak>
            
            <div class="bg-white rounded-[40px] p-10 max-w-md w-full mx-4 shadow-2xl text-center" @click.away="openLogoutModal = false">
                {{-- Judul Merah --}}
                <h3 class="text-2xl font-black text-[#E11D48] mb-6 tracking-tight">Apakah kamu yakin untuk keluar?</h3>
                
                {{-- Image Logout --}}
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('images/logout.png') }}" alt="Logout" class="w-48 h-auto object-contain">
                </div>

                {{-- Deskripsi --}}
                <p class="text-slate-500 font-medium leading-relaxed mb-10 px-4">
                    Keluar dari sistem mengharuskan kamu untuk <span class="italic">login</span> kembali.
                </p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <button @click="openLogoutModal = false" 
                            class="flex-1 px-8 py-3 border-2 border-[#0052CC] text-[#0052CC] font-bold rounded-2xl hover:bg-slate-50 transition-all active:scale-95">
                        Batalkan
                    </button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full px-8 py-3 bg-[#0052CC] text-white font-bold rounded-2xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95">
                            Ya, keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- TOAST NOTIFICATION --}}
        @if(session('success'))
            <div x-data="{ show: false, message: '{{ session('success') }}' }" 
                 x-init="() => { setTimeout(() => show = true, 100); setTimeout(() => show = false, 3000); }"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-4"
                 class="fixed bottom-10 left-10 z-[100]"
                 x-cloak>
                
                <div :class="{
                        'bg-[#0052CC]': message.includes('ditambahkan'), 
                        'bg-emerald-500': message.includes('disimpan') || message.includes('dihapus')
                     }" 
                     class="flex items-center gap-4 px-6 py-4 rounded-[24px] shadow-2xl shadow-blue-900/10 text-white min-w-[320px] border border-white/10 backdrop-blur-sm">
                    
                    <div class="bg-white/20 p-2 rounded-xl">
                        <template x-if="message.includes('ditambahkan')">
                            <i class="ph-bold ph-plus-circle text-xl"></i>
                        </template>
                        <template x-if="message.includes('disimpan')">
                            <i class="ph-bold ph-check-circle text-xl"></i>
                        </template>
                        <template x-if="message.includes('dihapus')">
                            <i class="ph-bold ph-trash text-xl"></i>
                        </template>
                    </div>

                    <div class="flex-1">
                        <p class="font-black tracking-tight text-[10px] uppercase opacity-70">Notifikasi Sistem</p>
                        <p class="text-sm font-bold leading-tight" x-text="message"></p>
                    </div>

                    <button @click="show = false" class="p-1 hover:bg-white/20 rounded-lg transition-colors">
                        <i class="ph-bold ph-x text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

    </body>
</html>