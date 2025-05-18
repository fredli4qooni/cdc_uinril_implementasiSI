<?php

// File: database/migrations/YYYY_MM_DD_HHMMSS_create_applications_table.php

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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users (Mahasiswa yang mendaftar)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // Jika user dihapus, pendaftarannya juga hilang

            // Foreign key ke tabel vacancies (Lowongan yang dilamar)
            $table->foreignId('vacancy_id')
                  ->constrained('vacancies')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // Jika lowongan dihapus, pendaftarannya juga hilang

            $table->dateTime('application_date')->default(now()); // Tanggal & waktu pendaftaran
            $table->enum('status', [
                        'pending',    // Baru diajukan oleh mahasiswa
                        'reviewed',   // Sedang/sudah ditinjau Admin/Perusahaan
                        'accepted',   // Diterima
                        'rejected',   // Ditolak
                        'cancelled'   // Dibatalkan oleh mahasiswa (opsional)
                    ])->default('pending');
            $table->text('admin_notes')->nullable(); // Catatan dari Admin (misal alasan ditolak)
            $table->text('company_notes')->nullable(); // Catatan dari Perusahaan (jika perusahaan bisa input)

            $table->timestamps(); // created_at akan mirip application_date, updated_at untuk perubahan status

            // Optional: Indeks untuk mempercepat query pencarian
            $table->index(['user_id', 'vacancy_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};