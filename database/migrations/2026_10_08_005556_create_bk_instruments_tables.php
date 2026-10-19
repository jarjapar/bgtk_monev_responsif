<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | BK SUBMISSIONS
        |--------------------------------------------------------------------------
        | Menyimpan setiap pengisian instrumen BK.
        |
        */
        Schema::create('bk_submissions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | IDENTITAS PETUGAS MONEV
            |--------------------------------------------------------------------------
            */

            $table->string('nama_petugas_monev');
            $table->string('instansi_petugas')->nullable();
            $table->string('lokasi_monev')->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS RESPONDEN
            |--------------------------------------------------------------------------
            */

            $table->string('nama_responden');
            $table->string('instansi_responden')->nullable();
            $table->string('kab_kota')->nullable();


            /*
            |--------------------------------------------------------------------------
            | HASIL PENILAIAN
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('jumlah_soal')->default(65);

            $table->unsignedInteger('jumlah_ya')->default(0);

            $table->unsignedInteger('jumlah_tidak')->default(0);

            $table->decimal('skor_persentase', 5, 2)->default(0);

            $table->enum('kategori', [
                'Baik / Kategori Tinggi',
                'Kurang / Kategori Rendah',
            ])->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Draft',
                'Selesai',
            ])->default('Draft');


            $table->timestamps();

        });


        /*
        |--------------------------------------------------------------------------
        | BK QUESTIONS
        |--------------------------------------------------------------------------
        | Master 65 pernyataan instrumen BK.
        |
        */

        Schema::create('bk_questions', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | LEVEL KIRKPATRICK
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('level');

            $table->string('level_nama');


            /*
            |--------------------------------------------------------------------------
            | BAGIAN / KELOMPOK PERTANYAAN
            |--------------------------------------------------------------------------
            */

            $table->string('bagian');

            $table->string('judul_bagian');


            /*
            |--------------------------------------------------------------------------
            | NOMOR PERTANYAAN
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('nomor');


            /*
            |--------------------------------------------------------------------------
            | PERNYATAAN
            |--------------------------------------------------------------------------
            */

            $table->text('pernyataan');


            /*
            |--------------------------------------------------------------------------
            | URUTAN TAMPIL
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('urutan');


            $table->boolean('aktif')->default(true);

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index([
                'level',
                'bagian',
                'urutan',
            ]);

        });


        /*
        |--------------------------------------------------------------------------
        | BK ANSWERS
        |--------------------------------------------------------------------------
        | Menyimpan jawaban Ya / Tidak untuk 65 pernyataan.
        |
        */

        Schema::create('bk_answers', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | RELASI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('bk_submission_id')
                ->constrained('bk_submissions')
                ->cascadeOnDelete();


            $table->foreignId('bk_question_id')
                ->constrained('bk_questions')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | JAWABAN
            |--------------------------------------------------------------------------
            |
            | true  = Ya
            | false = Tidak
            |
            */

            $table->boolean('jawaban');


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | SATU PERTANYAAN HANYA BOLEH MEMILIKI
            | SATU JAWABAN DALAM SATU PENGISIAN
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'bk_submission_id',
                'bk_question_id',
            ]);

        });


        /*
        |--------------------------------------------------------------------------
        | BK ESSAY ANSWERS
        |--------------------------------------------------------------------------
        | Menyimpan 3 pertanyaan uraian Bagian B.
        |
        */

        Schema::create('bk_essay_answers', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | RELASI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('bk_submission_id')
                ->constrained('bk_submissions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | NOMOR PERTANYAAN
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('nomor');


            /*
            |--------------------------------------------------------------------------
            | PERTANYAAN
            |--------------------------------------------------------------------------
            */

            $table->text('pertanyaan');


            /*
            |--------------------------------------------------------------------------
            | JAWABAN
            |--------------------------------------------------------------------------
            */

            $table->text('jawaban')->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | SATU NOMOR ESSAY HANYA SEKALI PER PENGISIAN
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'bk_submission_id',
                'nomor',
            ]);

        });
    }


    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_essay_answers');

        Schema::dropIfExists('bk_answers');

        Schema::dropIfExists('bk_questions');

        Schema::dropIfExists('bk_submissions');
    }
};