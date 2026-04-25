<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 1. Menampilkan Tabel (Index) dengan Fitur Filter & Sorting
     */
    public function index(Request $request)
    {
        $role = $request->query('role', 'siswa');
        
        // Ambil parameter sorting dan filter dari URL
        $sortBy = $request->query('sort', 'created_at'); // Default urutan berdasarkan waktu dibuat
        $direction = $request->query('direction', 'desc'); // Default terbaru di atas
        $filterClass = $request->query('class'); // Untuk filter kelas siswa

        // Mulai Query
        $query = User::where('role', $role)->with('student');

        // LOGIKA FILTER: Khusus untuk Siswa berdasarkan kelas
        if ($role === 'siswa' && $filterClass) {
            $query->where('class', $filterClass);
        }

        // LOGIKA SORTING
        // Jika sortir berdasarkan 'nama_anak' (khusus role orang_tua)
        if ($sortBy === 'nama_anak' && ($role === 'orang_tua' || $role === 'ortu')) {
            // Kita ambil data dulu baru kita urutkan koleksinya berdasarkan relasi
            $users = $query->get()->sortBy(function($user) {
                return $user->student->name ?? '';
            }, SORT_REGULAR, $direction === 'desc')->values();
        } else {
            // Urutan standar untuk kolom yang ada di tabel users (name, username, student_nisn, dll)
            $users = $query->orderBy($sortBy, $direction)->get();
        }

        return view('admin.users.index', compact('users', 'role', 'sortBy', 'direction', 'filterClass'));
    }

    /**
     * 2. Menampilkan Form Tambah (Create)
     */
    public function create(Request $request)
    {
        $role = $request->query('role', 'siswa');
        return view('admin.users.create', compact('role'));
    }

    /**
     * 3. Proses Simpan ke Database (Store)
     */
    public function store(Request $request)
    {
        $role = trim($request->role);
        $isOrtu  = ($role === 'orang_tua' || $role === 'ortu');
        $isAdmin = ($role === 'admin');
        $isGuru  = ($role === 'guru');
        $isSiswa = ($role === 'siswa');

        $label = ($isOrtu || $isAdmin) ? 'Username' : ($isGuru ? 'NIP' : 'NISN');

        $rules = [
            'role'     => 'required',
            'password' => 'required|min:8',
        ];

        if ($isOrtu) {
            $rules['username']     = 'required|string|min:3|unique:users,username';
            $rules['student_nisn'] = 'required|numeric|digits:10|exists:users,username';
        } elseif ($isAdmin) {
            $rules['username'] = 'required|string|min:3|unique:users,username';
            $rules['name']     = 'required|string|max:255';
            $rules['gender']   = 'required';
        } else {
            $rules['name']   = 'required|string|max:255';
            $rules['gender'] = 'required';
            $digits = $isGuru ? 18 : 10;
            $rules['username'] = "required|numeric|digits:$digits|unique:users,username";
            if ($isSiswa) { $rules['class'] = 'required'; }
        }

        $request->validate($rules);

        $userData = [
            'username'       => $request->username,
            'password'       => Hash::make($request->password),
            'password_plain' => $request->password,
            'role'           => $role,
        ];

        if ($isOrtu) {
            $userData['student_nisn'] = $request->student_nisn;
            $userData['name']         = 'Wali Murid';
        } else {
            $userData['name']   = $request->name;
            $userData['gender'] = $request->gender;
            $userData['class']  = $isSiswa ? $request->class : null;
        }

        User::create($userData);

        return redirect()->route('admin.users.index', ['role' => $role])
                         ->with('success', "Data berhasil ditambahkan");
    }

    /**
     * 4. Menampilkan Form Edit
     */
    public function edit(User $user)
    {
        $role = $user->role;
        return view('admin.users.edit', compact('user', 'role'));
    }

    /**
     * 5. Proses Update ke Database (Update)
     */
    public function update(Request $request, User $user)
    {
        $role = trim($user->role);
        $isOrtu = ($role === 'orang_tua' || $role === 'ortu');
        
        $rules = ['password' => 'nullable|min:8'];

        if ($isOrtu) {
            $rules['username']     = "required|string|min:3|unique:users,username,{$user->id}";
            $rules['student_nisn'] = "required|numeric|digits:10|exists:users,username";
        } else {
            $rules['name'] = 'required|string|max:255';
            $rules['gender'] = 'required';
            if ($role === 'admin') {
                $rules['username'] = "required|string|min:3|unique:users,username,{$user->id}";
            } else {
                $digits = ($role === 'guru') ? 18 : 10;
                $rules['username'] = "required|numeric|digits:$digits|unique:users,username,{$user->id}";
                $rules['class'] = ($role === 'siswa') ? 'required' : 'nullable';
            }
        }

        $request->validate($rules);

        $updateData = ['username' => $request->username];

        if ($isOrtu) {
            $updateData['student_nisn'] = $request->student_nisn;
        } else {
            $updateData['name']   = $request->name;
            $updateData['gender'] = $request->gender;
            $updateData['class']  = ($role === 'siswa') ? $request->class : null;
        }

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['password_plain'] = $request->password;
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index', ['role' => $role])
                         ->with('success', "Data berhasil disimpan");
    }

    /**
     * 6. Menghapus Data (Destroy)
     */
    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();
        
        return redirect()->route('admin.users.index', ['role' => $role])
                         ->with('success', 'Data berhasil dihapus');
    }
}