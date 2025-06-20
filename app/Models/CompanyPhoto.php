<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPhoto extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'photo_path', 'caption', 'order'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
