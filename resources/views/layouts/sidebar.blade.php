<div class="w-72 bg-[#0052CC] min-h-screen p-6 text-white flex flex-col shadow-xl">
    {{-- PROFILE SECTION --}}
    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-white/10">
        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center overflow-hidden border border-white/30">
            {{-- Menggunakan nama kamu sesuai database/summary --}}
            <img src="{{ asset('images/avatar.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="overflow-hidden">
            <p class="font-bold truncate text-sm">Syafira Fanya</p>
            <p class="text-[10px] opacity-60 uppercase tracking-widest font-black">Admin Utama</p>
        </div>
    </div>

    {{-- NAVIGATION SECTION --}}
    <nav class="space-y-1.5 flex-grow">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#0052CC] font-bold shadow-lg shadow-black/10' : 'hover:bg-white/10 text-blue-100' }}">
            <i class="ph-bold ph-house-line text-xl"></i>
            <span class="text-sm">Dashboard Utama</span>
        </a>

        <div class="pt-4 pb-2 px-4">
            <p class="text-[10px] text-blue-200/50 uppercase font-black tracking-widest">Manajemen Data</p>
        </div>

        {{-- Kelola Siswa --}}
        <a href="{{ route('admin.users.index', ['role' => 'siswa']) }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ (request('role') == 'siswa') ? 'bg-white text-[#0052CC] font-bold shadow-lg' : 'hover:bg-white/10 text-blue-100' }}">
            <i class="ph-bold ph-student text-xl"></i>
            <span class="text-sm">Kelola Data Siswa</span>
        </a>

        {{-- Kelola Guru --}}
        <a href="{{ route('admin.users.index', ['role' => 'guru']) }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ (request('role') == 'guru') ? 'bg-white text-[#0052CC] font-bold shadow-lg' : 'hover:bg-white/10 text-blue-100' }}">
            <i class="ph-bold ph-chalkboard-teacher text-xl"></i>
            <span class="text-sm">Kelola Data Guru</span>
        </a>

        {{-- Kelola Admin --}}
        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ (request('role') == 'admin') ? 'bg-white text-[#0052CC] font-bold shadow-lg' : 'hover:bg-white/10 text-blue-100' }}">
            <i class="ph-bold ph-user-gear text-xl"></i>
            <span class="text-sm">Kelola Data Admin</span>
        </a>

        {{-- Kelola Orang Tua --}}
        <a href="{{ route('admin.users.index', ['role' => 'ortu']) }}" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ (request('role') == 'ortu' || request('role') == 'orang_tua') ? 'bg-white text-[#0052CC] font-bold shadow-lg' : 'hover:bg-white/10 text-blue-100' }}">
            <i class="ph-bold ph-users-three text-xl"></i>
            <span class="text-sm">Kelola Data Orang Tua</span>
        </a>
    </nav>

    {{-- LOGOUT SECTION (Memicu Modal di app.blade.php) --}}
    <div class="mt-auto pt-6 border-t border-white/10">
        <button @click="openLogoutModal = true" 
                type="button" 
                class="w-full flex items-center gap-3 px-4 py-3 text-red-100 hover:text-white hover:bg-red-500/20 rounded-2xl transition-all group">
            <i class="ph-bold ph-sign-out text-xl"></i>
            <span class="text-sm font-bold">Keluar Sistem</span>
        </button>
    </div>
</div>