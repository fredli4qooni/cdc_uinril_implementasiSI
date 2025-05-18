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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // Email kontak perusahaan
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_path')->nullable(); // Path logo perusahaan
            // Kolom untuk Akun Login Perusahaan (jika dipisah)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Jika perusahaan punya akun login sendiri
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
