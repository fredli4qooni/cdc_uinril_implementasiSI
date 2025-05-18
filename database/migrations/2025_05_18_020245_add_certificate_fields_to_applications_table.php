<?php

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
        Schema::table('applications', function (Blueprint $table) {
            // Kolom untuk path file sertifikat
            $table->string('certificate_path')->nullable()->after('company_notes');
            // Kolom untuk tanggal penerbitan sertifikat
            $table->date('certificate_issued_at')->nullable()->after('certificate_path');
            // (Opsional) Kolom untuk menandai magang selesai (selain status 'accepted')
            // Jika Anda ingin status 'accepted' tetap berarti diterima, dan ada status baru
            // $table->boolean('is_completed')->default(false)->after('status');
            // atau modifikasi enum status untuk menambahkan 'completed'

            // Jika Anda memilih memodifikasi enum status:
            // DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('pending', 'reviewed', 'accepted', 'rejected', 'cancelled', 'completed') NOT NULL DEFAULT 'pending'");
            // PERHATIAN: Modifikasi enum bisa rumit dan berbeda antar database.
            // Lebih aman mungkin menggunakan kolom boolean is_completed atau status baru jika dari awal tidak direncanakan.
            // Untuk kesederhanaan awal, kita akan asumsikan status 'accepted' bisa diikuti dengan upload sertifikat,
            // atau Admin/Perusahaan mengubah status ke 'completed' secara manual.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['certificate_path', 'certificate_issued_at']);
            // $table->dropColumn('is_completed'); // Jika ditambahkan
            // Jika modifikasi enum, reverse-nya juga perlu hati-hati
            // DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('pending', 'reviewed', 'accepted', 'rejected', 'cancelled') NOT NULL DEFAULT 'pending'");
        });
    }
};