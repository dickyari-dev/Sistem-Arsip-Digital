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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->string('nomor_surat')->unique();
            $table->string('file_surat'); // path ke file PDF
            $table->string('kode_surat')->nullable();
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('penerima');

            // Tambahan untuk surat masuk / keluar jika diperlukan
            $table->enum('jenis_surat', ['masuk', 'keluar'])->default('masuk');

            // Status disposisi
            $table->enum('status_disposisi', ['pending', 'disposisi', 'revisi'])->default('pending');
            $table->text('keterangan_revisi')->nullable();        // catatan tambahan

            // Kolom tambahan
            $table->text('perihal')->nullable();           // isi ringkasan surat
            $table->text('keterangan')->nullable();        // catatan tambahan
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete(); // yang input
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
