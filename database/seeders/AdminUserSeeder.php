<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User di-import

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin CDC',
            'email' => 'admin@cdc.uinril.ac.id', 
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'email_verified_at' => now(), 
        ]);
    }
}