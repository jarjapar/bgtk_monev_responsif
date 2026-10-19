
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            // A. Identitas BCKS
            $table->string('nama_bcks')->nullable();
            $table->string('unit_kerja_bcks')->nullable();
            $table->string('angkatan_pelatihan_bcks')->nullable();

            // B. Identitas Responden
            $table->string('nama_responden')->nullable();
            $table->string('unit_kerja_responden')->nullable();
            $table->string('status_responden')->nullable();

            // C. Petugas Monev
            $table->string('nama_petugas_monev')->nullable();
            $table->string('unit_kerja_petugas')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            $table->dropColumn([
                'nama_bcks',
                'unit_kerja_bcks',
                'angkatan_pelatihan_bcks',
                'nama_responden',
                'unit_kerja_responden',
                'status_responden',
                'nama_petugas_monev',
                'unit_kerja_petugas',
            ]);
        });
    }
};
