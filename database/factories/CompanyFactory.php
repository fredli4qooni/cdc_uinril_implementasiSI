<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Untuk slug atau nama unik jika perlu

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyName = $this->faker->unique()->company . ' ' . $this->faker->companySuffix;
        return [
            'name' => $companyName,
            'email' => $this->faker->unique()->companyEmail,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'description' => $this->faker->realText(200), // Teks deskripsi lebih panjang
            'website' => 'https://www.' . Str::slug(explode(' ', $companyName)[0] ?? 'example') . '.com', // Website dummy
            // 'logo_path' bisa diisi nanti jika ingin upload logo secara otomatis saat seeding (lebih kompleks)
            // atau biarkan null dan Admin/Perusahaan yang upload
            'logo_path' => null, // Atau path ke logo placeholder jika ada
            'industry' => $this->faker->randomElement(['Teknologi Informasi', 'Keuangan', 'Manufaktur', 'Pendidikan', 'Kesehatan', 'Media', 'Retail', 'Konstruksi']),
            'employee_count_range' => $this->faker->randomElement(['1-10', '11-50', '51-200', '201-500', '500+']),
            'full_address' => $this->faker->address, // Bisa sama dengan address atau lebih detail
            'google_maps_embed_url' => null, // Sulit di-generate otomatis, biarkan null
            'linkedin_url' => 'https://linkedin.com/company/' . Str::slug($companyName),
            'instagram_url' => 'https://instagram.com/' . Str::slug(explode(' ', $companyName)[0] ?? 'example'),
            'twitter_url' => null,
            // 'user_id' akan diisi jika perusahaan ini dibuatkan akun login oleh Admin Seeder/proses lain
            'user_id' => null,
        ];
    }
}