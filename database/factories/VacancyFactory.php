<?php

namespace Database\Factories;

use App\Models\Vacancy;
use App\Models\Company; // Untuk mengambil ID company secara acak
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon; // Untuk manipulasi tanggal

class VacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pastikan ada perusahaan di database sebelum menjalankan factory ini
        // Jika tidak ada, factory ini akan error saat mencoba mengambil company_id
        $companyIds = Company::pluck('id')->toArray();
        if (empty($companyIds)) {
            // Buat satu company dulu jika tidak ada
            $company = Company::factory()->create();
            $companyIds[] = $company->id;
        }

        $jobTitle = $this->faker->jobTitle . ' Intern';
        $startDate = Carbon::instance($this->faker->dateTimeBetween('+1 week', '+3 months'));

        return [
            'company_id' => $this->faker->randomElement($companyIds), // Ambil ID company secara acak
            'title' => $jobTitle,
            'description' => $this->faker->paragraphs(3, true), // 3 paragraf teks
            'requirements' => "- " . $this->faker->sentence . "\n- " . $this->faker->sentence . "\n- " . $this->faker->sentence, // Persyaratan dummy
            'location' => $this->faker->city . ', ' . $this->faker->state,
            // Deadline antara 2 minggu hingga 2 bulan dari sekarang
            'deadline' => $this->faker->boolean(80) ? Carbon::instance($this->faker->dateTimeBetween($startDate, $startDate->copy()->addMonths(2)))->toDateString() : null, // 80% punya deadline
            'slots' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['open', 'open', 'open', 'closed']), // Lebih banyak 'open'
            'type' => 'kerjasama', // Fokus ke lowongan kerjasama
        ];
    }
}