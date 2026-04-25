<x-app-layout>
    <div class="max-w-5xl mx-auto"> <div class="mb-10">
            <h1 class="text-3xl font-[900] text-slate-800 tracking-tight">Ringkasan Data Pengguna</h1>
            <p class="text-slate-500 mt-1 font-medium">Klik pada kartu untuk mengelola data masing-masing role.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
            
            <a href="{{ route('admin.users.index', ['role' => 'siswa']) }}" 
               class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 group">
                <div class="flex items-center justify-between mb-8">
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/siswa.png') }}" alt="Siswa" class="w-full h-full object-contain transform group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div class="text-right">
                        <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest">Data Siswa</h3>
                        <div class="flex items-baseline justify-end gap-2 mt-1">
                            <span class="text-6xl font-black text-slate-800 tracking-tighter">{{ $siswaCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between text-blue-600 font-bold text-sm">
                    <span>Kelola Siswa</span>
                    <i class="ph-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('admin.users.index', ['role' => 'guru']) }}" 
               class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 group">
                <div class="flex items-center justify-between mb-8">
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/guru.png') }}" alt="Guru" class="w-full h-full object-contain transform group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div class="text-right">
                        <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest">Data Guru</h3>
                        <div class="flex items-baseline justify-end gap-2 mt-1">
                            <span class="text-6xl font-black text-slate-800 tracking-tighter">{{ $guruCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between text-indigo-600 font-bold text-sm">
                    <span>Kelola Guru</span>
                    <i class="ph-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
               class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 group">
                <div class="flex items-center justify-between mb-8">
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/admin.png') }}" alt="Admin" class="w-full h-full object-contain transform group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div class="text-right">
                        <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest">Data Admin</h3>
                        <div class="flex items-baseline justify-end gap-2 mt-1">
                            <span class="text-6xl font-black text-slate-800 tracking-tighter">{{ $adminCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between text-rose-600 font-bold text-sm">
                    <span>Kelola Admin</span>
                    <i class="ph-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('admin.users.index', ['role' => 'orang_tua']) }}" 
               class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 group">
                <div class="flex items-center justify-between mb-8">
                    <div class="w-20 h-20 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/orangtua.png') }}" alt="Orang Tua" class="w-full h-full object-contain transform group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div class="text-right">
                        <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest">Data Orang Tua</h3>
                        <div class="flex items-baseline justify-end gap-2 mt-1">
                            <span class="text-6xl font-black text-slate-800 tracking-tighter">{{ $ortuCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between text-amber-600 font-bold text-sm">
                    <span>Kelola Wali</span>
                    <i class="ph-arrow-right"></i>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>