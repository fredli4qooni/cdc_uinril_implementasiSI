<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany;
class Vacancy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'requirements',
        'location',
        'deadline',
        'slots',
        'status',
        'type',
    ];

    /**
     * The attributes that should be cast.
     * Untuk memastikan tipe data kolom tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'date', // Otomatis cast ke object Carbon (untuk tanggal)
        'slots' => 'integer',
    ];

    /**
     * Mendapatkan data Company (perusahaan) yang memiliki lowongan ini.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Mendapatkan semua pendaftaran (applications) untuk lowongan ini.
     * (Akan digunakan nanti saat membuat modul pendaftaran)
     */
    
     public function applications(): HasMany
     {
         return $this->hasMany(Application::class);
     }
}