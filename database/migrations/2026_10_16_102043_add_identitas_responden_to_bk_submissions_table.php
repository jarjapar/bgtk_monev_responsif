
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bk_submissions', function (Blueprint $table) {
            $table->string('jabatan_responden')->nullable();
            $table->string('jabatan_lainnya')->nullable();
            $table->string('satuan_pendidikan')->nullable();
            $table->unsignedTinyInteger('masa_kerja')->nullable();
            $table->string('nama_pelatihan')->nullable();
            $table->date('tanggal_pengisian')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bk_submissions', function (Blueprint $table) {
            $table->dropColumn([
                'jabatan_responden',
                'jabatan_lainnya',
                'satuan_pendidikan',
                'masa_kerja',
                'nama_pelatihan',
                'tanggal_pengisian',
            ]);
        });
    }
};
