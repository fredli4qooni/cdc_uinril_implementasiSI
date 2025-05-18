<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Admin biasanya hanya update status & notes. User_id & vacancy_id diset saat mahasiswa mendaftar.
     */
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'application_date',
        'status',
        'admin_notes',
        'company_notes',
        'certificate_path',         // <-- Tambahkan
        'certificate_issued_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'application_date' => 'datetime',
        'certificate_issued_at' => 'date', // <-- Tambahkan
        // 'is_completed' => 'boolean',   // <-- Tambahkan jika menggunakan Opsi A
    ];

    /**
     * Mendapatkan data User (Mahasiswa) yang mendaftar.
     */
    public function user(): BelongsTo
    {
        // Eager load profile student saat memanggil relasi user
        return $this->belongsTo(User::class)->withDefault()->with('studentProfile');
    }

    /**
     * Mendapatkan data Vacancy (Lowongan) yang dilamar.
     */
    public function vacancy(): BelongsTo
    {
         // Eager load company saat memanggil relasi vacancy
        return $this->belongsTo(Vacancy::class)->withDefault()->with('company');
    }
}