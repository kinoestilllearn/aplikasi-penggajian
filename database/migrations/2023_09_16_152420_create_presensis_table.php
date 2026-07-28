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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            // $table->enum('tipe_log', ['masuk', 'keluar'])->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'cuti', 'alpha'])->default('hadir');
            $table->timestamp('waktu_masuk')->nullable();
            $table->timestamp('waktu_keluar')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
