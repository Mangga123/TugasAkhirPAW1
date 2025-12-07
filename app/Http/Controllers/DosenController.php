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
        // Ambil user yang role-nya 'dosen'
        $dosen = User::where('role', 'dosen')->latest()->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    /**
     * Form tambah dosen.
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Simpan data dosen baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen', // Role otomatis dosen
            'department_id' => 1, // Default dulu
            'angkatan' => null,   // Dosen tidak punya angkatan
        ]);

        return redirect()->route('dosen.index');
    }

    /**
     * Form edit dosen.
     */
    public function edit(string $id)
    {
        $dosen = User::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Update data dosen.
     */
    public function update(Request $request, string $id)
    {
        $dosen = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        ]);

        $dataToUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $dosen->update($dataToUpdate);

        return redirect()->route('dosen.index');
    }

    /**
     * Hapus data dosen.
     */
    public function destroy(string $id)
    {
        $dosen = User::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index');
    }
}