<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('bcks_pengisians', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | IDENTITAS BCKS
            |--------------------------------------------------------------------------
            */

            $table->string('nama_bcks');

            $table->string('unit_kerja')->nullable();

            $table->string('angkatan_pelatihan')->nullable();


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS RESPONDEN
            |--------------------------------------------------------------------------
            */

            $table->string('nama_responden');

            $table->string('unit_kerja_responden')->nullable();

            $table->enum('status_responden', [
                'BCKS',
                'Atasan Langsung / Pengawas Sekolah',
                'Perwakilan Guru / Tenaga Kependidikan',
            ]);


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS PETUGAS MONEV
            |--------------------------------------------------------------------------
            */

            $table->string('nama_petugas_monev');

            $table->string('unit_kerja_petugas')->nullable();


            /*
            |--------------------------------------------------------------------------
            | WAKTU EVALUASI
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_evaluasi');


            /*
            |--------------------------------------------------------------------------
            | HASIL PENILAIAN
            |--------------------------------------------------------------------------
            |
            | Total maksimal 27 indikator x skor 4 = 108.
            |
            */

            $table->unsignedSmallInteger('total_skor')
                ->default(0);

            $table->decimal('nilai_akhir', 5, 2)
                ->default(0);

            $table->enum('predikat', [
                'Sangat Baik',
                'Baik',
                'Cukup',
                'Perlu Pembinaan',
            ])->nullable();


            /*
            |--------------------------------------------------------------------------
            | PERTANYAAN TERBUKA
            |--------------------------------------------------------------------------
            */

            $table->text('dampak_implementasi_rptks')->nullable();

            $table->text('kendala_strategi_mitigasi')->nullable();

            $table->text('perubahan_pengambilan_keputusan')->nullable();

            $table->text('dukungan_lingkungan_sekolah')->nullable();

            $table->text('keberlanjutan_program_inovasi')->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS PENGISIAN
            |--------------------------------------------------------------------------
            */

            $table->enum('status_pengisian', [
                'Draft',
                'Selesai',
            ])->default('Draft');


            $table->timestamps();
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('bcks_pengisians');
    }
};