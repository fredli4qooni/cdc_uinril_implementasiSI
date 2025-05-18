<?php

// File: database/migrations/YYYY_MM_DD_HHMMSS_create_student_profiles_table.php

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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            // Foreign key unique ke tabel users (One-to-One)
            $table->foreignId('user_id')
                  ->unique() // Pastikan satu user hanya punya satu profil
                  ->constrained('users') // Merujuk ke tabel 'users'
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // Jika user dihapus, profilnya juga dihapus

            $table->string('nim', 20)->unique(); // Nomor Induk Mahasiswa (unik)
            $table->string('major')->nullable(); // Jurusan / Program Studi
            $table->year('entry_year')->nullable(); // Tahun Masuk
            $table->string('phone_number', 25)->nullable(); // No HP mahasiswa
            $table->text('address')->nullable(); // Alamat
            $table->string('cv_path')->nullable(); // Path file CV yang diupload mahasiswa
            $table->text('bio')->nullable(); // Deskripsi singkat/bio mahasiswa (opsional)
            // Tambahkan field lain jika perlu: tempat_lahir, tanggal_lahir, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};