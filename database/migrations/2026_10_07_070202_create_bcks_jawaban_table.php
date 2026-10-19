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
        Schema::create('bcks_jawaban', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI PENGISIAN
            |--------------------------------------------------------------------------
            */

            $table->foreignId('bcks_pengisian_id')
                ->constrained('bcks_pengisians')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS INDIKATOR
            |--------------------------------------------------------------------------
            |
            | nomor_indikator menyimpan nomor pertanyaan 1 sampai 27.
            |
            */

            $table->unsignedTinyInteger('nomor_indikator');

            /*
            |--------------------------------------------------------------------------
            | LEVEL EVALUASI
            |--------------------------------------------------------------------------
            */

            $table->enum('level', [
                'Reaction',
                'Learning',
                'Behavior',
                'Results',
            ]);


            /*
            |--------------------------------------------------------------------------
            | SKOR
            |--------------------------------------------------------------------------
            |
            | Setiap pertanyaan hanya boleh memiliki satu skor:
            |
            | 1 = skor 1
            | 2 = skor 2
            | 3 = skor 3
            | 4 = skor 4
            |
            */

            $table->unsignedTinyInteger('skor');


            /*
            |--------------------------------------------------------------------------
            | CATATAN
            |--------------------------------------------------------------------------
            |
            | Catatan bersifat opsional.
            |
            */

            $table->text('catatan')->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            |
            | Satu pengisian tidak boleh memiliki nomor indikator
            | yang sama lebih dari satu kali.
            |
            */

            $table->unique([
                'bcks_pengisian_id',
                'nomor_indikator',
            ]);
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('bcks_jawaban');
    }
};