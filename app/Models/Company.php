<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;   // Jika ada relasi lain
class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_number',
        'description',
        'website',
        'logo_path',
        'user_id',
        'industry',                 // <-- Tambah
        'employee_count_range',     // <-- Tambah
        'full_address',             // <-- Tambah
        'google_maps_embed_url',    // <-- Tambah
        'linkedin_url',             // <-- Tambah
        'instagram_url',            // <-- Tambah
        'twitter_url',              // <-- Tambah
    ];

    /**
     * Mendapatkan data User (akun login) yang terkait dengan Company.
     * Opsional: jika setiap perusahaan PASTI punya akun login.
     * Jika tidak pasti, relasi ini mungkin tidak selalu dibutuhkan dari sisi Company.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan semua lowongan (vacancies) yang dimiliki oleh perusahaan ini.
     */
    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    /**
     * Mendapatkan semua foto galeri yang dimiliki oleh perusahaan ini.
     * ===> INI METHOD YANG PERLU DIPASTIKAN ADA DAN BENAR <===
     */
    public function photos(): HasMany
    {
        // Relasi 'satu Company memiliki banyak CompanyPhoto'
        // Argumen kedua (opsional) adalah foreign key di tabel company_photos (default: company_id)
        // Argumen ketiga (opsional) adalah local key di tabel companies (default: id)
        return $this->hasMany(CompanyPhoto::class)->orderBy('order'); // Urutkan berdasarkan kolom 'order' jika ada
    }
}
