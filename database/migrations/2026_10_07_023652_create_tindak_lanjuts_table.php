<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sekolah_id')
                ->constrained('sekolahs')
                ->cascadeOnDelete();

            $table->foreignId('wawancara_id')
                ->nullable()
                ->constrained('wawancaras')
                ->nullOnDelete();

            $table->string('judul_tindak_lanjut');

            $table->text('uraian_tindak_lanjut');

            $table->string('penanggung_jawab');

            $table->date('tanggal_mulai')
                ->nullable();

            $table->date('target_selesai')
                ->nullable();

            $table->enum('status', [
                'Belum Dimulai',
                'Dalam Proses',
                'Selesai',
            ])->default('Belum Dimulai');

            $table->text('keterangan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};