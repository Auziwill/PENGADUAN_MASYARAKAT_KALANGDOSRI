<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // pastikan kolom kategori memang ada sebelum dihapus
            if (Schema::hasColumn('pengaduan', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->string('kategori')->nullable(); // kalau di-rollback, kolomnya muncul lagi
        });
    }
};