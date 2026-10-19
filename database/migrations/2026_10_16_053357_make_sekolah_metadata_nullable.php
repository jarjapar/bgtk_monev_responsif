
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sekolahs', function (Blueprint $table) {
            $table->string('npsn', 20)->nullable()->change();
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'SMK'])
                ->nullable()
                ->change();
            $table->string('kabupaten_kota')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Tidak mengembalikan kolom menjadi wajib agar data
        // sekolah yang dibuat otomatis tetap aman.
    }
};
