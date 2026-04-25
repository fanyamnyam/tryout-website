<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        {{-- JUDUL HALAMAN DINAMIS --}}
        <h1 class="text-3xl font-black text-[#0052CC] mb-10 tracking-tight">
            Edit Data {{ ($role == 'orang_tua' || $role == 'ortu') ? 'Orang Tua' : ucfirst(str_replace('_', ' ', $role)) }}
        </h1>

        <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- 1. BLOK IDENTITAS (ORTU vs ROLE LAIN) --}}
                <div class="grid grid-cols-1 {{ ($role == 'orang_tua' || $role == 'ortu') ? '' : 'md:grid-cols-2' }} gap-8">
                    @if($role == 'orang_tua' || $role == 'ortu')
                        {{-- KHUSUS ORTU: NISN ANAK & USERNAME --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">NISN Anak</label>
                            <input type="text" name="student_nisn" value="{{ old('student_nisn', $user->student_nisn) }}" 
                                placeholder="Masukkan NISN anak" 
                                class="w-full px-6 py-4 bg-slate-50 border @error('student_nisn') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('student_nisn') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Username Orang Tua</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                                class="w-full px-6 py-4 bg-slate-50 border @error('username') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('username') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                    @else
                        {{-- ROLE LAIN: NISN/NIP & NAMA --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">
                                {{ $role == 'admin' ? 'Username' : ($role == 'guru' ? 'NIP' : 'NISN') }}
                            </label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none">
                        </div>
                    @endif
                </div>

                {{-- 2. GENDER & KELAS (DITAMPILKAN JIKA BUKAN ORTU) --}}
                @if($role != 'orang_tua' && $role != 'ortu')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Jenis Kelamin</label>
                            <select name="gender" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl appearance-none outline-none">
                                <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        @if($role == 'siswa')
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Kelas</label>
                            <select name="class" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl appearance-none">
                                <option value="6 Ibnu Sina" {{ old('class', $user->class) == '6 Ibnu Sina' ? 'selected' : '' }}>6 Ibnu Sina</option>
                                <option value="6 Mushab" {{ old('class', $user->class) == '6 Mushab' ? 'selected' : '' }}>6 Mushab</option>
                                <option value="6 Sholahuddin" {{ old('class', $user->class) == '6 Sholahuddin' ? 'selected' : '' }}>6 Sholahuddin</option>
                            </select>
                        </div>
                        @endif
                    </div>
                @endif

                {{-- 3. BAGIAN PASSWORD (MENAMPILKAN PASSWORD SAAT INI) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-black text-[#0052CC] uppercase tracking-wider">Password Login</label>
                    <div x-data="{ showPassword: false }" class="relative">
                        {{-- Value ditarik dari password_plain supaya bisa diintip --}}
                        <input :type="showPassword ? 'text' : 'password'" 
                            name="password" 
                            value="{{ old('password', $user->password_plain) }}"
                            placeholder="Password akun ini" 
                            class="w-full px-6 py-4 bg-slate-50 border @error('password') border-rose-500 @else border-slate-200 @enderror rounded-2xl outline-none pr-16 text-slate-700 font-bold transition-all focus:ring-2 focus:ring-blue-500">
                        
                        {{-- Tombol Toggle Ikon Mata --}}
                        <button type="button" @click="showPassword = !showPassword" 
                            class="absolute inset-y-0 right-0 pr-6 flex items-center hover:scale-110 transition-transform">
                            
                            <img src="{{ asset('images/show-pass.png') }}" class="w-6 h-6" x-show="!showPassword" x-cloak>
                            <img src="{{ asset('images/hide-pass.png') }}" class="w-6 h-6" x-show="showPassword" x-cloak>
                        </button>
                    </div>
                    @error('password') <p class="text-xs text-rose-500 font-bold mt-1">{{ $message }}</p> @enderror
                    <p class="text-[10px] text-slate-400 font-medium italic">*Klik ikon mata untuk melihat password saat ini.</p>
                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-50">
                    <a href="{{ route('admin.users.index', ['role' => $role]) }}" class="px-8 py-4 rounded-2xl font-bold text-slate-400 hover:text-slate-600 transition-all">
                        Batalkan
                    </a>
                    <button type="submit" class="bg-[#0052CC] hover:bg-blue-700 text-white px-12 py-4 rounded-2xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<style> [x-cloak] { display: none !important; } </style>