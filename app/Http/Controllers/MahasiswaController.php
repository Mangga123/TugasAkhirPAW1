<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Tambahan penting untuk password

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar semua mahasiswa.
     */
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->latest()->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Menampilkan form tambah mahasiswa.
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Wajib diisi)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'angkatan' => 'required|numeric',
            'password' => 'required|min:6',
        ]);

        // 2. Masukkan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
            'password' => Hash::make($request->password), // Password di-encrypt
            'role' => 'mahasiswa', // Role otomatis jadi mahasiswa
            'department_id' => 1, // Kita set default 1 dulu (biar tidak error)
        ]);

        // 3. Kembali ke halaman tabel dengan sukses
        return redirect()->route('mahasiswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Menampilkan form untuk edit data.
     */
    public function edit(string $id)
    {
        // Cari mahasiswa berdasarkan ID, kalau tidak ada tampilkan error 404
        $mahasiswa = User::findOrFail($id);
        
        // Tampilkan view edit dan kirim datanya
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id, 
            'angkatan' => 'required|numeric',
            'password' => 'nullable|min:6',
        ]);

        $dataToUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $mahasiswa->update($dataToUpdate);

        return redirect()->route('mahasiswa.index');
    }

    public function destroy(string $id)
    {
        $mahasiswa = User::findOrFail($id);

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index');
    }
}