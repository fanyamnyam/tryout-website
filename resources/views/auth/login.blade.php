<x-guest-layout>
    <div class="flex flex-col lg:flex-row min-h-screen bg-white">
        
        {{-- SISI KIRI: ILUSTRASI & INFO ROLE --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-b from-[#E9B159] via-[#8E93B0] to-[#436EB8] p-16 flex-col justify-center items-center text-white relative">
            <div class="max-w-md text-center">
                <img src="{{ asset('images/login.png') }}" alt="Illustration" class="w-full h-auto mb-12 drop-shadow-2xl">
                
                <h2 class="text-3xl font-extrabold mb-4 leading-tight">
                    Role yang dipilih adalah <br> 
                    <span class="text-yellow-300 font-black text-4xl">
                        {{-- Mengubah tampilan 'ortu' atau 'orang_tua' jadi 'Orang Tua' agar rapi --}}
                        @if($role == 'orang_tua' || $role == 'ortu') 
                            Orang Tua 
                        @else 
                            {{ ucfirst($role) }} 
                        @endif
                    </span>
                </h2>
                <p class="text-white/90 text-lg font-medium leading-relaxed">
                    Silakan masukan 
                    {{-- Logika Teks Deskripsi --}}
                    @if($role == 'siswa') 
                        NISN 
                    @elseif($role == 'guru') 
                        NIP 
                    @elseif($role == 'orang_tua' || $role == 'ortu') 
                        Username Orang Tua
                    @else 
                        Username Admin 
                    @endif 
                    dan kata sandi yang sudah disediakan
                </p>
            </div>
        </div>

        {{-- SISI KANAN: FORM LOGIN --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-12 md:px-24 lg:px-32">
            <div class="max-w-md w-full mx-auto">
                
                <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('images/logo_sdit.png') }}" class="w-10 h-10 object-contain">
                    <span class="text-[#0052CC] font-extrabold text-sm tracking-[0.2em] uppercase">SDIT AL-IMAN</span>
                </div>

                <h1 class="text-5xl font-[900] text-[#0052CC] mb-2 tracking-tight">Selamat Datang!</h1>
                <p class="text-gray-400 mb-12 font-medium text-lg">Masuk untuk memulai sesi Anda</p>

                {{-- FORM START --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    {{-- INPUT HIDDEN ROLE: Ini kunci agar backend tahu role apa yang mencoba login --}}
                    <input type="hidden" name="role" value="{{ $role }}">

                    {{-- INPUT USERNAME / NISN / NIP --}}
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-[#0052CC] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input type="text" name="username" value="{{ old('username') }}" required autofocus
                            {{-- LOGIKA PLACEHOLDER DINAMIS --}}
                            placeholder="@if($role == 'siswa')NISN Siswa @elseif($role == 'guru')NIP Guru @elseif($role == 'orang_tua' || $role == 'ortu')Username Orang Tua @else Username Admin @endif"
                            class="w-full pl-14 pr-6 py-4 border-2 border-gray-100 rounded-3xl focus:ring-0 focus:border-[#0052CC] outline-none transition-all text-gray-700 font-semibold text-lg bg-gray-50/50 @error('username') border-red-500 @enderror">
                        
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    {{-- INPUT PASSWORD DENGAN FITUR SHOW/HIDE --}}
                    <div class="relative group" x-data="{ showPassword: false }">
                        {{-- Ikon Gembok (Sisi Kiri) --}}
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-[#0052CC] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>

                        {{-- Input Password --}}
                        <input :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            placeholder="Kata Sandi"
                            class="w-full pl-14 pr-16 py-4 border-2 border-gray-100 rounded-3xl focus:ring-0 focus:border-[#0052CC] outline-none transition-all text-gray-700 font-semibold text-lg bg-gray-50/50 @error('password') border-red-500 @enderror">

                        {{-- Tombol Toggle Ikon Mata (Sisi Kanan) --}}
                        <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-6 flex items-center hover:scale-110 transition-transform focus:outline-none">

                            <img src="{{ asset('images/show-pass.png') }}" class="w-6 h-6 opacity-50 group-focus-within:opacity-100" x-show="!showPassword" x-cloak>
                            <img src="{{ asset('images/hide-pass.png') }}" class="w-6 h-6 opacity-50 group-focus-within:opacity-100" x-show="showPassword" x-cloak>
                        </button>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0052CC] hover:bg-[#0041a3] text-white font-black text-xl rounded-3xl shadow-[0_10px_20px_rgba(0,82,204,0.3)] transition-all transform active:scale-[0.97] mt-6">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>