<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vacancy_id'];
    // Relasi ke User dan Vacancy bisa ditambahkan jika perlu akses dari Bookmark
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
