<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pkgsd_mbi_pengisians', function (Blueprint $table) {
            $table->id();

            // Relasi ke Data Sekolah
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();

            // Identitas guru dan pelaksanaan monev
            $table->string('nama_guru');
            $table->string('nama_sekolah');
            $table->string('kelas_fase')->nullable();
            $table->string('topik_materi')->nullable();
            $table->string('nama_petugas_monev');
            $table->string('jabatan_penilai');
            $table->date('tanggal_monev');
            $table->text('sumber_data_bukti')->nullable();

            // Level 1–4 disimpan sebagai JSON
            $table->json('level_1_jawaban')->nullable();
            $table->json('level_2_jawaban')->nullable();
            $table->json('level_3_jawaban')->nullable();
            $table->json('level_4_jawaban')->nullable();

            // Status pengisian
            $table->string('status')->default('Selesai');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkgsd_mbi_pengisians');
    }
};
