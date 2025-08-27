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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('kode_pegawai');
            $table->string('nama_pegawai');
            $table->foreignId('kode_cabang')->constrained('cabangs', 'kode_cabang')->onDelete('restrict');
            $table->foreignId('kode_jabatan')->constrained('jabatans', 'kode_jabatan')->onDelete('restrict');
            $table->date('tanggal_mulai_kontrak');
            $table->date('tanggal_habis_kontrak');
            $table->enum('status_pegawai', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
