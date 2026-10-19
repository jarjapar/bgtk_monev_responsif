<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();

            $table->string('npsn', 20)->unique();
            $table->string('nama_sekolah');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'SMK']);
            $table->string('kabupaten_kota');
            $table->string('kecamatan')->nullable();
            $table->text('alamat')->nullable();

            $table->enum('status_monitoring', [
                'Sudah Dimonitor',
                'Belum Dimonitor'
            ])->default('Belum Dimonitor');

            $table->year('tahun_monitoring')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};