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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();

            // Relasi ke surat
            $table->foreignId('surat_id')->constrained('surats')->onDelete('cascade');

            // Relasi ke user camat
            $table->foreignId('camat_id')->constrained('users')->onDelete('cascade');

            // Relasi ke user pegawai
            $table->foreignId('pegawai_id')->constrained('users')->onDelete('cascade');

            // Isi disposisi
            $table->text('catatan')->nullable();

            // Waktu disposisi
            $table->timestamp('tanggal_disposisi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
