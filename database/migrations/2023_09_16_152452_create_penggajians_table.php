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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id();
            $table->char('no_ref', 20)->unique();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_hingga')->nullable();
            $table->char('periode', 20)->nullable();
            $table->enum('status', ['draf', 'disetujui', 'dibatalkan'])->default('draf');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedTinyInteger('kehadiran')->nullable();
            $table->unsignedTinyInteger('absen')->nullable();
            $table->unsignedTinyInteger('alpha')->nullable();
            $table->unsignedTinyInteger('cuti')->nullable();
            $table->char('lama_lembur', 10)->nullable();
            $table->decimal('gaji_pokok', 10, 2)->nullable();
            $table->decimal('jumlah_tunjangan_tetap', 10, 2)->nullable();
            $table->decimal('jumlah_insentif', 10, 2)->nullable();
            $table->decimal('jumlah_lembur', 10, 2)->nullable();
            $table->decimal('jumlah_potongan_nwnp', 10, 2)->nullable();
            $table->decimal('jumlah_potongan_bpjs', 10, 2)->nullable();
            $table->decimal('jumlah_penambah_gaji', 10, 2)->nullable();
            $table->decimal('jumlah_potongan_gaji', 10, 2)->nullable();
            $table->decimal('total_gaji', 10, 2)->nullable();
            $table->unsignedBigInteger('dibuat_oleh')->nullable();
            $table->unsignedBigInteger('disetujui_oleh')->nullable();
            $table->unsignedBigInteger('dibatalkan_oleh')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
