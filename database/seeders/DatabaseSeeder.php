<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Operator
        User::create([
            'nis_nip' => 'ADMIN001',
            'name' => 'Operator Sekolah (Admin)',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Wali Kelas / Dosen (NIP requested: 10001)
        User::create([
            'nis_nip' => '10001',
            'name' => 'Drs. Budi Santoso, M.Pd',
            'role' => 'homeroom_teacher',
            'class_name' => 'XII RPL 1',
            'major' => 'Rekayasa Perangkat Lunak',
            'password' => Hash::make('password'),
        ]);

        // Siswa Sample 1
        User::create([
            'nis_nip' => '20261001',
            'name' => 'Ahmad Rizky',
            'role' => 'student',
            'class_name' => 'XII RPL 1',
            'major' => 'Rekayasa Perangkat Lunak',
            'password' => Hash::make('password'),
        ]);

        // Siswa Sample 2
        User::create([
            'nis_nip' => '20261002',
            'name' => 'Siti Nurhaliza',
            'role' => 'student',
            'class_name' => 'XII RPL 1',
            'major' => 'Rekayasa Perangkat Lunak',
            'password' => Hash::make('password'),
        ]);
    }
}
