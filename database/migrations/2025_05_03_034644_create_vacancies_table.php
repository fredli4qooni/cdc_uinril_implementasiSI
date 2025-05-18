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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel companies
            $table->foreignId('company_id')
                  ->constrained('companies') // Merujuk ke tabel 'companies'
                  ->onUpdate('cascade') // Jika id company berubah, update juga di sini
                  ->onDelete('cascade'); // Jika company dihapus, hapus juga lowongannya

            $table->string('title'); // Judul/Posisi Lowongan
            $table->text('description'); // Deskripsi pekerjaan/magang
            $table->text('requirements')->nullable(); // Persyaratan
            $table->string('location')->nullable(); // Lokasi penempatan
            $table->date('deadline')->nullable(); // Batas waktu pendaftaran
            $table->integer('slots')->unsigned()->default(1); // Jumlah kuota/posisi yang tersedia
            $table->enum('status', ['open', 'closed'])->default('open'); // Status lowongan (dibuka/ditutup)
            $table->enum('type', ['kerjasama', 'umum'])->default('kerjasama'); // Jenis lowongan (fokus ke kerjasama dulu)
            // Tambahkan kolom lain jika perlu, misal: duration, salary_range, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};