
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gembira_pengisians', function (Blueprint $table) {
            $table->id();

            // Biodata
            $table->string('nama_guru');
            $table->string('nama_sekolah');
            $table->string('kelas_fase')->nullable();
            $table->string('topik_materi')->nullable();
            $table->string('nama_petugas_monev');
            $table->string('jabatan_penilai')->nullable();
            $table->date('tanggal_monev');
            $table->text('sumber_data_bukti')->nullable();

            // Level 1: Reaction (29 indikator)
            $table->json('level_1_jawaban')->nullable();

            // Level 2: Learning (23 indikator)
            $table->json('level_2_jawaban')->nullable();

            // Level 3: Behavior (23 indikator)
            $table->date('tanggal_observasi')->nullable();
            $table->string('durasi_pembelajaran')->nullable();
            $table->unsignedInteger('jumlah_murid_hadir')->nullable();
            $table->unsignedInteger('observasi_ke')->nullable();
            $table->json('level_3_jawaban')->nullable();

            // Level 4: Results (11 indikator)
            $table->json('level_4_jawaban')->nullable();

            // Status pengisian
            $table->enum('status', ['Draft', 'Selesai'])
                ->default('Draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gembira_pengisians');
    }
};
