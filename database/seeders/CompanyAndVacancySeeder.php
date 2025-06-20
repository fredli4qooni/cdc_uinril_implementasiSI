<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\User; // Untuk mengaitkan company dengan user (opsional)
use Illuminate\Support\Facades\Hash; // Untuk password user (opsional)

class CompanyAndVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama (opsional, hati-hati jika ada data penting)
        // Vacancy::query()->delete();
        // Company::query()->delete();
        // User::where('role', 'perusahaan')->delete(); // Jika ingin menghapus user perusahaan juga

        $this->command->info('Seeding companies and vacancies...');

        // 1. Buat 10 Perusahaan
        // Kita bisa buat user login untuk beberapa perusahaan ini
        $companies = Company::factory(10)->create()->each(function ($company, $index) {
            // Buat akun user untuk 5 perusahaan pertama (contoh)
            if ($index < 5) {
                $user = User::factory()->create([
                    'name' => $company->name . ' Contact',
                    'email' => strtolower(str_replace(' ', '.', explode(' ', $company->name)[0] ?? 'company'.$index)) . '@example.net',
                    'password' => Hash::make('password123'),
                    'role' => 'perusahaan',
                    'email_verified_at' => now(),
                ]);
                // Kaitkan user dengan company
                $company->user_id = $user->id;
                $company->save();
            }
        });

        $this->command->info(count($companies) . ' companies created.');

        // 2. Buat 10 Lowongan
        // Lowongan akan secara otomatis mengambil company_id dari perusahaan yang sudah ada
        // Jika ingin lebih spesifik, Anda bisa loop $companies dan buat lowongan untuk masing-masing
        if ($companies->isNotEmpty()) {
            // Contoh: Setiap perusahaan membuat 1-2 lowongan (total bisa lebih dari 10)
            // Atau buat 10 lowongan yang tersebar di perusahaan-perusahaan tersebut.
            // Untuk memastikan tepat 10 lowongan:
            for ($i = 0; $i < 10; $i++) {
                Vacancy::factory()->create([
                    'company_id' => $companies->random()->id, // Pilih company secara acak dari yang sudah dibuat
                ]);
            }
            $this->command->info('10 vacancies created.');
            // Jika ingin setiap company punya minimal 1 vacancy:
            // $companies->each(function ($company) {
            //     Vacancy::factory()->count(rand(1, 2))->create([ // Buat 1 atau 2 lowongan per company
            //         'company_id' => $company->id,
            //     ]);
            // });
            // $this->command->info('Vacancies created for companies.');
        } else {
            $this->command->warn('No companies found to create vacancies for. Please seed companies first or ensure CompanyFactory works.');
        }

        $this->command->info('Company and Vacancy seeding completed.');
    }
}