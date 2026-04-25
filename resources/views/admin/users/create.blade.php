<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        {{-- JUDUL HALAMAN --}}
        <h1 class="text-3xl font-black text-[#0052CC] mb-10 tracking-tight">
            Tambah Data {{ ($role == 'orang_tua' || $role == 'ortu') ? 'Orang Tua' : ucfirst(str_replace('_', ' ', $role)) }}
        </h1>

        <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-8" autocomplete="off">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">

                {{-- ==========================================================
                     1. BLOK KHUSUS ORANG TUA (VERTIKAL - 3 FIELD)
                     ========================================================== --}}
                @if($role == 'orang_tua' || $role == 'ortu')
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">NISN</label>
                        <input type="text" name="student_nisn" value="{{ old('student_nisn') }}" 
                            placeholder="Masukkan NISN anak" 
                            class="w-full px-6 py-4 bg-slate-50 border @error('student_nisn') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        @error('student_nisn') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Username Orang Tua</label>
                        <input type="text" name="username" value="{{ old('username') }}" 
                            placeholder="Buat username untuk orang tua" 
                            class="w-full px-6 py-4 bg-slate-50 border @error('username') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        @error('username') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Password</label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" 
                                placeholder="Buat password untuk orang tua" 
                                autocomplete="new-password"
                                class="w-full px-6 py-4 bg-slate-50 border @error('password') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none pr-16 focus:ring-2 focus:ring-blue-500 transition-all">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-6 flex items-center hover:scale-110 transition-transform">
                                <img src="{{ asset('images/show-pass.png') }}" class="w-6 h-6" x-show="!showPassword" x-cloak>
                                <img src="{{ asset('images/hide-pass.png') }}" class="w-6 h-6" x-show="showPassword" x-cloak>
                            </button>
                        </div>
                        @error('password') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                {{-- ==========================================================
                     2. BLOK UNTUK ROLE LAIN (GRID - LENGKAP)
                     ========================================================== --}}
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- IDENTITAS --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">
                                @if($role == 'admin') Username @elseif($role == 'guru') NIP @else NISN @endif
                            </label>
                            <input type="text" name="username" value="{{ old('username') }}" 
                                placeholder="Masukkan {{ $role == 'admin' ? 'username' : ($role == 'guru' ? '18 digit NIP' : '10 digit NISN') }}" 
                                class="w-full px-6 py-4 bg-slate-50 border @error('username') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('username') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NAMA LENGKAP --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-6 py-4 bg-slate-50 border @error('name') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('name') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- JENIS KELAMIN --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Jenis Kelamin</label>
                            <select name="gender" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl appearance-none outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- KELAS --}}
                        @if($role == 'siswa')
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Kelas</label>
                            <select name="class" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl appearance-none outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                <option value="6 Ibnu Sina" {{ old('class') == '6 Ibnu Sina' ? 'selected' : '' }}>6 Ibnu Sina</option>
                                <option value="6 Mushab" {{ old('class') == '6 Mushab' ? 'selected' : '' }}>6 Mushab</option>
                                <option value="6 Sholahuddin" {{ old('class') == '6 Sholahuddin' ? 'selected' : '' }}>6 Sholahuddin</option>
                            </select>
                        </div>
                        @endif
                    </div>

                    {{-- PASSWORD LOGIN --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Password Login</label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" 
                                placeholder="Buat password login akun ini" 
                                autocomplete="new-password"
                                class="w-full px-6 py-4 bg-slate-50 border @error('password') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none pr-16 focus:ring-2 focus:ring-blue-500 transition-all">
                            
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-6 flex items-center hover:scale-110 transition-transform">
                                <img src="{{ asset('images/show-pass.png') }}" class="w-6 h-6" x-show="!showPassword" x-cloak>
                                <img src="{{ asset('images/hide-pass.png') }}" class="w-6 h-6" x-show="showPassword" x-cloak>
                            </button>
                        </div>
                        @error('password') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div class="flex justify-end pt-6 border-t border-slate-50">
                    <button type="submit" class="bg-[#0052CC] hover:bg-blue-700 text-white px-12 py-4 rounded-2xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95">
                        Simpan Data {{ ($role == 'orang_tua' || $role == 'ortu') ? 'Orang Tua' : ucfirst(str_replace('_', ' ', $role)) }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<style> [x-cloak] { display: none !important; } </style>