<x-app-layout>
    <div class="max-w-7xl mx-auto" x-data="{ openDeleteModal: false, deleteUrl: '', userName: '' }">
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-black text-[#0052CC] tracking-tight">
                Kelola Data {{ ($role == 'orang_tua' || $role == 'ortu') ? 'Orang Tua' : ucfirst(str_replace('_', ' ', $role)) }}
            </h1>
            
            <div class="flex items-center gap-4">
                {{-- DROPDOWN FILTER HANYA MUNCUL UNTUK SISWA --}}
                @if($role == 'siswa' && $users->isNotEmpty())
                    <form action="{{ route('admin.users.index') }}" method="GET" id="filterForm" class="relative">
                        <input type="hidden" name="role" value="siswa">
                        {{-- Tetap bawa parameter sort & direction saat ganti kelas --}}
                        <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                        <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}">
                        
                        <select name="class" onchange="this.form.submit()" 
                            class="appearance-none bg-white border border-blue-200 text-[#0052CC] px-6 py-2 pr-10 rounded-full font-bold text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm cursor-pointer min-w-[200px]">
                            <option value="">Seluruh Kelas</option>
                            <option value="6 Ibnu Sina" {{ request('class') == '6 Ibnu Sina' ? 'selected' : '' }}>6 Ibnu Sina</option>
                            <option value="6 Mushab" {{ request('class') == '6 Mushab' ? 'selected' : '' }}>6 Mushab</option>
                            <option value="6 Sholahuddin" {{ request('class') == '6 Sholahuddin' ? 'selected' : '' }}>6 Sholahuddin</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-[#0052CC]">
                            <i class="ph-bold ph-caret-down text-[10px]"></i>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        @if($users->isEmpty() && !request('class'))
            <div class="flex flex-col items-center justify-center min-h-[60vh]">
                <div class="w-72 h-72 mb-8">
                    <img src="{{ asset('images/emptydata.png') }}" alt="Empty Data" class="w-full h-full object-contain drop-shadow-xl">
                </div>
                <h2 class="text-2xl font-bold text-slate-700 mb-6 tracking-tight">Belum ada data {{ str_replace('_', ' ', $role) }}</h2>
                <a href="{{ route('admin.users.create', ['role' => $role]) }}" class="flex items-center gap-2 bg-[#0052CC] hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200 active:scale-95">
                    Tambah data <span class="text-xl">+</span>
                </a>
            </div>
        @else
            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-100/50">
                            <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">No</th>
                            
                            <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'username', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-2 group">
                                    @if($role == 'orang_tua' || $role == 'ortu') Username Ortu @elseif($role == 'admin') Username @elseif($role == 'guru') NIP @else NISN @endif
                                    <i class="ph-bold ph-arrows-down-up opacity-50 group-hover:opacity-100 transition-opacity"></i>
                                </a>
                            </th>

                            @if($role == 'orang_tua' || $role == 'ortu')
                                <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'student_nisn', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-2 group">
                                        NISN Anak <i class="ph-bold ph-arrows-down-up opacity-50 group-hover:opacity-100"></i>
                                    </a>
                                </th>
                                <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_anak', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-2 group">
                                        Nama Lengkap Anak <i class="ph-bold ph-arrows-down-up opacity-50 group-hover:opacity-100"></i>
                                    </a>
                                </th>
                                <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">Kelas</th>
                            @else
                                <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-2 group">
                                        Nama Lengkap <i class="ph-bold ph-arrows-down-up opacity-50 group-hover:opacity-100"></i>
                                    </a>
                                </th>
                                <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">L/P</th>
                                @if($role == 'siswa')
                                    <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'class', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-2 group">
                                            Kelas <i class="ph-bold ph-arrows-down-up opacity-50 group-hover:opacity-100"></i>
                                        </a>
                                    </th>
                                @endif
                            @endif
                            
                            <th class="px-6 py-5 text-[#1E3A8A] font-black text-sm uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $index => $user)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 text-slate-600 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-slate-600 font-bold tracking-tight">{{ $user->username }}</td>
                            
                            @if($role == 'orang_tua' || $role == 'ortu')
                                <td class="px-6 py-4 text-slate-600 font-medium">{{ $user->student_nisn }}</td>
                                <td class="px-6 py-4 text-slate-800 font-bold">{{ $user->student->name ?? 'Siswa Tidak Ditemukan' }}</td>
                                <td class="px-6 py-4 text-slate-600 font-medium">{{ $user->student->class ?? '-' }}</td>
                            @else
                                <td class="px-6 py-4 text-slate-800 font-bold">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-slate-600 uppercase font-bold">{{ $user->gender ?? '-' }}</td>
                                @if($role == 'siswa')
                                    <td class="px-6 py-4 text-slate-600">{{ $user->class }}</td>
                                @endif
                            @endif

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="hover:scale-110 transition-transform">
                                        <img src="{{ asset('images/edit.png') }}" alt="Edit" class="w-6 h-6">
                                    </a>
                                    <button type="button" 
                                            @click="openDeleteModal = true; deleteUrl = '{{ route('admin.users.destroy', $user->id) }}'; userName = '{{ $user->username }}'"
                                            class="hover:scale-110 transition-transform">
                                        <img src="{{ asset('images/delete.png') }}" alt="Hapus" class="w-6 h-6">
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="fixed bottom-10 right-10">
                <a href="{{ route('admin.users.create', ['role' => $role]) }}" class="flex items-center gap-2 bg-[#0052CC] hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-black shadow-2xl shadow-blue-300 transition-all active:scale-95">
                    Tambah data <span class="text-xl">+</span>
                </a>
            </div>
        @endif

        {{-- Modal Hapus --}}
        <div x-show="openDeleteModal" class="fixed inset-0 z-[99] flex items-center justify-center bg-black/50 backdrop-blur-sm" x-transition x-cloak>
            <div class="bg-white rounded-[40px] p-10 max-w-md w-full mx-4 shadow-2xl text-center" @click.away="openDeleteModal = false">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center">
                        <img src="{{ asset('images/hapus.png') }}" class="w-16 h-16">
                    </div>
                </div>
                <h3 class="text-2xl font-black text-rose-600 mb-2 tracking-tight">Hapus data?</h3>
                <p class="text-slate-500 font-medium leading-relaxed mb-8">
                    Yakin mau menghapus data <span class="font-black text-slate-800" x-text="userName"></span>?
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button @click="openDeleteModal = false" class="flex-1 px-8 py-3 border-2 border-blue-100 text-[#0052CC] font-bold rounded-xl hover:bg-slate-50 transition-all">Batalkan</button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-8 py-3 bg-[#0052CC] text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">Ya, hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>