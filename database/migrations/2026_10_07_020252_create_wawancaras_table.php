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
    Schema::create('wawancaras', function (Blueprint $table) {
        $table->id();

        $table->foreignId('instrumen_id')
            ->constrained('instrumens')
            ->cascadeOnDelete();

        $table->foreignId('sekolah_id')
            ->constrained('sekolahs')
            ->cascadeOnDelete();

        $table->date('tanggal_wawancara');

        $table->string('nama_narasumber');

        $table->string('jabatan_narasumber')->nullable();

        $table->string('nama_pewawancara');

        $table->enum('status', [
            'Belum Dilaksanakan',
            'Selesai'
        ])->default('Belum Dilaksanakan');

        $table->text('hasil_wawancara')->nullable();

        $table->text('catatan')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancaras');
    }
};
