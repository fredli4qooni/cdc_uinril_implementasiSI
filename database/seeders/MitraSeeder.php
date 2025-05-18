<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user baru
        $user = User::create([
            'name' => 'PT. Telkom Indonesia',
            'email' => 'telkom@cdc.uin',
            'password' => Hash::make('telkom12345'), // Ganti dengan password yang aman
            'role' => 'perusahaan',
            'email_verified_at' => now(),
        ]);

        // Cari company berdasarkan ID
        $company = Company::find(1);

        // Hubungkan dengan user
        if ($company) {
            $company->user_id = $user->id;
            $company->save();
        } else {
            $this->command->error("Company dengan ID 1 tidak ditemukan.");
        }
    }
}
