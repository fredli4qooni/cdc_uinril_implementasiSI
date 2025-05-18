<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\User;
use App\Models\Vacancy;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa mahasiswa dan lowongan kerjasama yang ada
        $students = User::where('role', 'mahasiswa')->limit(5)->get();
        $vacancies = Vacancy::where('type', 'kerjasama')->limit(3)->get();

        if ($students->count() > 0 && $vacancies->count() > 0) {
            // Contoh 1: Budi mendaftar ke lowongan pertama
            Application::create([
                'user_id' => $students->first()->id,
                'vacancy_id' => $vacancies->first()->id,
                'application_date' => now()->subDays(5), // 5 hari lalu
                'status' => 'pending',
            ]);

            // Contoh 2: Citra mendaftar ke lowongan pertama, status diubah
             if ($students->count() >= 2) {
                Application::create([
                    'user_id' => $students[1]->id,
                    'vacancy_id' => $vacancies->first()->id,
                    'application_date' => now()->subDays(3),
                    'status' => 'reviewed',
                    'admin_notes' => 'CV sedang direview oleh perusahaan.',
                ]);
            }

             // Contoh 3: Budi mendaftar ke lowongan kedua, diterima
             if ($vacancies->count() >= 2) {
                 Application::create([
                    'user_id' => $students->first()->id,
                    'vacancy_id' => $vacancies[1]->id,
                    'application_date' => now()->subDays(10),
                    'status' => 'accepted',
                    'admin_notes' => 'Selamat! Silakan hubungi HRD perusahaan.',
                ]);
             }

             // Contoh 4: Citra mendaftar ke lowongan ketiga, ditolak
              if ($students->count() >= 2 && $vacancies->count() >= 3) {
                 Application::create([
                    'user_id' => $students[1]->id,
                    'vacancy_id' => $vacancies[2]->id,
                    'application_date' => now()->subDays(2),
                    'status' => 'rejected',
                    'admin_notes' => 'Kualifikasi belum sesuai.',
                ]);
             }

        } else {
             $this->command->info('Tidak ada data mahasiswa atau lowongan kerjasama untuk membuat pendaftaran contoh.');
        }
    }
}