<?php

// File: database/migrations/YYYY_MM_DD_HHMMSS_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Event atau Lowongan
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->enum('type', ['event', 'loker_umum']); // Jenis: Acara Karir atau Info Loker Umum
            $table->string('source_url')->nullable(); // Link ke sumber asli/pendaftaran
            $table->dateTime('start_datetime')->nullable(); // Tanggal & Waktu Mulai (untuk event)
            $table->dateTime('end_datetime')->nullable(); // Tanggal & Waktu Selesai (untuk event)
            $table->string('location')->nullable(); // Lokasi event atau perusahaan (untuk loker)
            $table->string('organizer')->nullable(); // Penyelenggara (untuk event)
            $table->string('image_path')->nullable(); // Path gambar/poster (opsional)
            $table->boolean('is_published')->default(true); // Status publikasi (Draft/Published)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};