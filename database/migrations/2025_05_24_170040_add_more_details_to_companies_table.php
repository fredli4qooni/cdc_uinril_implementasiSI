<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('industry')->nullable()->after('website'); // Industri perusahaan
            $table->string('employee_count_range')->nullable()->after('industry'); // Misal: "10-50", "50-200", "200+"
            $table->string('full_address')->nullable()->after('address'); // Alamat lebih detail untuk peta
            $table->string('google_maps_embed_url')->nullable()->after('full_address'); // URL embed Google Maps

            // Kolom untuk Social Media (bisa juga dalam bentuk JSON jika banyak)
            $table->string('linkedin_url')->nullable()->after('google_maps_embed_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->string('twitter_url')->nullable()->after('instagram_url');
            // Tambahkan sosmed lain jika perlu
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'industry',
                'employee_count_range',
                'full_address',
                'google_maps_embed_url',
                'linkedin_url',
                'instagram_url',
                'twitter_url'
            ]);
        });
    }
};