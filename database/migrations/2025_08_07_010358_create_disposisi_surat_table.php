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
        Schema::create('disposisi_surat', function (Blueprint $table) {
            $table->id();

            // FK ke tabel surat
            $table->foreignId('surat_id')->constrained('surats')->onDelete('cascade');

            // FK ke pegawai penerima disposisi (user)
            $table->foreignId('pegawai_id')->constrained('users')->onDelete('cascade');

            // FK user yang mendisposisikan
            $table->foreignId('dari_user_id')->nullable()->constrained('users')->onDelete('set null');

            // Catatan tambahan
            $table->text('catatan')->nullable();

            // Status disposisi
            $table->enum('status', ['belum_dibaca', 'dibaca', 'selesai'])->default('belum_dibaca');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi_surat');
    }
};
