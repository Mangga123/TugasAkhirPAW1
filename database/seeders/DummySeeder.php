<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Template;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Data Prodi
        $deptTIF = Department::create([
            'name' => 'Teknik Informatika',
            'code' => 'TIF'
        ]);
        
        $deptSI = Department::create([
            'name' => 'Sistem Informasi',
            'code' => 'SI'
        ]);

        // 2. Buat Akun ADMIN (Teknisi)
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@filkom.ub.ac.id',
            'password' => Hash::make('123456'), // Passwordnya 123456
            'role' => 'admin',
        ]);

        // 3. Buat Akun DOSEN (Pengirim Pesan)
        User::create([
            'name' => 'Pak Dosen A',
            'email' => 'dosen@filkom.ub.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'department_id' => $deptTIF->id, // Dosen TIF
        ]);

        // 4. Buat Akun MAHASISWA 1 (Target: TIF 2023)
        User::create([
            'name' => 'Mhs Budi (TIF 23)',
            'email' => 'budi@student.ub.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'mahasiswa',
            'department_id' => $deptTIF->id,
            'angkatan' => 2023,
        ]);

        // 5. Buat Akun MAHASISWA 2 (Target: SI 2022 - Buat tes filter nanti)
        User::create([
            'name' => 'Mhs Siti (SI 22)',
            'email' => 'siti@student.ub.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'mahasiswa',
            'department_id' => $deptSI->id,
            'angkatan' => 2022,
        ]);

        // 6. Buat Contoh Template Pesan
        Template::create([
            'name' => 'Undangan Rapat',
            'content' => 'Halo, diharap kehadirannya di Ruang Rapat besok jam 09.00 WIB. Terimakasih.'
        ]);
    }
}