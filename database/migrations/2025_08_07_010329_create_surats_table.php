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

            // Relasi ke categories
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');

            $table->string('nama_surat');
            $table->string('slug')->unique();
            $table->string('nomor_surat')->unique();
            $table->string('kode_surat')->nullable();
            $table->string('file_surat'); // path ke file PDF
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('penerima');

            // Jenis surat (masuk / keluar)
            $table->enum('jenis_surat', ['masuk', 'keluar'])->default('masuk');

            // Status disposisi
            $table->enum('status_disposisi', ['pending', 'disposisi'])->default('pending');

            // Kolom revisi
            $table->text('status_revisi')->nullable();
            $table->text('keterangan_revisi')->nullable();
            $table->text('jawaban_revisi')->nullable();

            // Kolom tambahan
            $table->text('perihal')->nullable();
            $table->text('keterangan')->nullable();

            // Relasi ke users (yang input data)
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

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
