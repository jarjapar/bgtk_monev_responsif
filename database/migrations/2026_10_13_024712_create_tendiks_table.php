
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tendiks', function (Blueprint $table) {
            $table->id();

            // Identitas petugas Monev
            $table->string('nama_petugas_monev');
            $table->string('instansi_petugas');

            // Identitas responden Tendik
            $table->string('nama_responden');
            $table->string('jabatan_responden');
            $table->string('jabatan_lainnya')->nullable();
            $table->string('satuan_pendidikan');
            $table->unsignedSmallInteger('masa_kerja');
            $table->string('nama_pelatihan');
            $table->date('tanggal_pengisian');

            // Jawaban tertutup butir 1–43, masing-masing bernilai 1–4
            for ($i = 1; $i <= 43; $i++) {
                $table->unsignedTinyInteger('jawaban_' . $i)->nullable();
            }

            // Rekap skor empat level
            $table->decimal('skor_level_1', 5, 2)->nullable();
            $table->decimal('skor_level_2', 5, 2)->nullable();
            $table->decimal('skor_level_3', 5, 2)->nullable();
            $table->decimal('skor_level_4', 5, 2)->nullable();
            $table->decimal('skor_keseluruhan', 5, 2)->nullable();
            $table->string('predikat')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tendiks');
    }
};
