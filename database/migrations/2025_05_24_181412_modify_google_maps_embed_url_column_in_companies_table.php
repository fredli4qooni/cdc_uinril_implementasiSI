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
        Schema::table('companies', function (Blueprint $table) {
            // Ubah tipe kolom google_maps_embed_url menjadi TEXT
            // TEXT bisa menampung hingga 65,535 karakter, seharusnya cukup.
            // Jika butuh lebih panjang lagi, bisa gunakan MEDIUMTEXT atau LONGTEXT.
            $table->text('google_maps_embed_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Kembalikan ke VARCHAR(255) jika di-rollback (hati-hati jika ada data panjang)
            // Jika Anda tahu sebelumnya bukan 255, sesuaikan.
            $table->string('google_maps_embed_url', 1000)->nullable()->change();
            // Atau jika Anda tahu batas atas sebelumnya:
            // $table->string('google_maps_embed_url', PREVIOUS_LENGTH)->nullable()->change();
            // Lebih aman untuk tidak terlalu mengecilkan lagi di down(), atau pastikan tidak ada data yang terpotong.
            // Dalam prakteknya, jika sudah diubah ke TEXT, jarang sekali perlu di-rollback ke string yang lebih pendek.
            // Jika Anda yakin dengan batas sebelumnya (misal 1000 karakter seperti validasi kita):
            // $table->string('google_maps_embed_url', 1000)->nullable()->change();
            // Atau untuk lebih aman, jika rollback, biarkan saja sebagai TEXT atau ubah ke string dengan panjang yang sangat besar.
            // Namun, untuk konsistensi, kita coba kembalikan ke string dengan panjang yang mungkin sudah kita validasi.
            // Batas validasi kita adalah 1000, jadi kita bisa set itu.
        });
    }
};