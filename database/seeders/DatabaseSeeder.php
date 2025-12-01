<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use App\Models\Resident;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT ROLES (Penting!)
        $adminRole = Role::create(['role_name' => 'Admin']);
        $residentRole = Role::create(['role_name' => 'Resident']);

        // 2. BUAT AKUN ADMIN (Ini akun login kamu nanti)
        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com', // Email login admin
            'password' => Hash::make('password'), // Password: password
            'phone' => '081234567890',
        ]);

        // 3. BUAT AKUN PENGHUNI (User biasa)
        $warga = User::create([
            'role_id' => $residentRole->id,
            'name' => 'Budi Santoso',
            'email' => 'warga@gmail.com', // Email login warga
            'password' => Hash::make('password'),
            'phone' => '089876543210',
        ]);

        // 4. BUAT DATA UNIT APARTEMEN (Dummy Data)
        $units = [
            ['unit_number' => '101', 'tower' => 'A', 'floor' => 1, 'type' => 'Studio', 'status' => 'Terisi'],
            ['unit_number' => '102', 'tower' => 'A', 'floor' => 1, 'type' => 'Studio', 'status' => 'Kosong'],
            ['unit_number' => '103', 'tower' => 'A', 'floor' => 1, 'type' => '1BR', 'status' => 'Kosong'],
            ['unit_number' => '201', 'tower' => 'A', 'floor' => 2, 'type' => '2BR', 'status' => 'Maintenance'],
            ['unit_number' => '202', 'tower' => 'B', 'floor' => 2, 'type' => 'Studio', 'status' => 'Kosong'],
        ];

        foreach ($units as $unitData) {
            Unit::create($unitData);
        }

        // 5. HUBUNGKAN USER WARGA KE UNIT 101 (Agar dia terdata sebagai penghuni)
        // Kita ambil unit 101 yang statusnya 'Terisi' tadi
        $unitTerisi = Unit::where('unit_number', '101')->first();

        Resident::create([
            'user_id' => $warga->id,
            'unit_id' => $unitTerisi->id,
            'start_date' => now(), // Masuk hari ini
            'status' => 'Aktif',
        ]);
    }
}