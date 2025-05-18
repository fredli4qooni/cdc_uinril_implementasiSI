<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh 1
        $student1 = User::create([
            'name' => 'Budi Mahasiswa',
            'email' => 'budi.mhs@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
        ]);

        StudentProfile::create([
            'user_id' => $student1->id,
            'nim' => '191101001',
            'major' => 'Teknik Informatika',
            'entry_year' => 2019,
            'phone_number' => '081234567890',
        ]);

        // Contoh 2
        $student2 = User::create([
            'name' => 'Citra Pelajar',
            'email' => 'citra.mhs@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
        ]);

        StudentProfile::create([
            'user_id' => $student2->id,
            'nim' => '202102005',
            'major' => 'Sistem Informasi',
            'entry_year' => 2020,
        ]);

        // Tambahkan data contoh lainnya jika perlu
    }
}