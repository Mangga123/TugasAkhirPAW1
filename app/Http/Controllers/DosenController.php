<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Menampilkan daftar dosen.
     */
    public function index()
    {
        $dosens = User::where('role', 'dosen')->latest()->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    /**
     * Menampilkan form tambah dosen.
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Menyimpan data dosen baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // PERUBAHAN: Minimal 6 karakter & hapus 'confirmed' karena tidak ada kolom konfirmasi di form
            'password' => ['required', 'string', 'min:6'],
        ]);

        // 2. Simpan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
            'angkatan' => null,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit dosen.
     */
    public function edit($id)
    {
        $dosen = User::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Mengupdate data dosen.
     */
    public function update(Request $request, $id)
    {
        $dosen = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$dosen->id],
        ]);

        $dosen->name = $request->name;
        $dosen->email = $request->email;

        // Jika password diisi, update passwordnya
        if ($request->filled('password')) {
            // PERUBAHAN: Validasi update password juga minimal 6 & tanpa konfirmasi
            $request->validate([
                'password' => ['string', 'min:6'],
            ]);
            $dosen->password = Hash::make($request->password);
        }

        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    /**
     * Menghapus data dosen.
     */
    public function destroy($id)
    {
        $dosen = User::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus!');
    }
}