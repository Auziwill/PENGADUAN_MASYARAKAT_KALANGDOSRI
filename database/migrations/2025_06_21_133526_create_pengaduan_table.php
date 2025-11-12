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
    Schema::create('pengaduan', function (Blueprint $table) {
        $table->id('id_pengaduan');
        $table->unsignedBigInteger('id_user');
        $table->string('judul', 150);
        $table->string('kategori', 100)->nullable();
        $table->text('isi');
        $table->string('lokasi')->nullable();
        $table->string('foto')->nullable(); // path ke file gambar
        $table->timestamp('tanggal_pengaduan')->useCurrent();
        $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
        $table->timestamps();

        $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
    });
}

};
