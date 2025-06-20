<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('company_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('photo_path'); // Path ke file gambar
            $table->string('caption')->nullable(); // Caption/deskripsi foto (opsional)
            $table->unsignedInteger('order')->default(0); // Untuk urutan tampil (opsional)
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('company_photos'); }
};