<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
