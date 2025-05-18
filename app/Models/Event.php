<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'source_url',
        'start_datetime',
        'end_datetime',
        'location',
        'organizer',
        'image_path',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_datetime' => 'datetime', // Cast ke object Carbon
        'end_datetime' => 'datetime', // Cast ke object Carbon
        'is_published' => 'boolean', // Cast ke true/false
    ];

    // Tidak ada relasi foreign key langsung di sini untuk CRUD dasar ini
}