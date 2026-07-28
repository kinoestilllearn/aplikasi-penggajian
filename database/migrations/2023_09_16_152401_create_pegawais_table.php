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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->char('no_pegawai', 16)->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedBigInteger('departemen_id');
            $table->unsignedBigInteger('posisi_id');
            $table->enum('status_pegawai', ['tetap', 'kontrak', 'HL'])->default('tetap');
            $table->unsignedTinyInteger('masa_kerja_tahun');
            $table->decimal('gaji_pokok', 10, 2);
            $table->decimal('tunjangan_tetap', 10, 2);
            $table->timestamps();

            $table->foreign('departemen_id')->references('id')->on('departemen')->cascadeOnDelete();
            $table->foreign('posisi_id')->references('id')->on('posisi')->cascadeOnDelete();
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
