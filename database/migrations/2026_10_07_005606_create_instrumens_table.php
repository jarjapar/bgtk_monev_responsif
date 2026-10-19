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
        Schema::create('instrumens', function (Blueprint $table) {
            $table->id();

            $table->string('kode_instrumen', 50)->unique();

            $table->string('nama_instrumen');

            $table->enum('jenis_instrumen', [
                'Pemantauan',
                'Evaluasi',
                'Monitoring'
            ]);

            $table->text('deskripsi')->nullable();

            $table->enum('status', [
                'Draft',
                'Aktif',
                'Selesai'
            ])->default('Draft');

            $table->integer('jumlah_pertanyaan')->default(0);

            $table->decimal('capaian', 5, 2)->default(0);

            $table->date('tanggal_mulai')->nullable();

            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumens');
    }
};