
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            'ALTER TABLE wawancaras
             MODIFY instrumen_id BIGINT UNSIGNED NULL,
             MODIFY sekolah_id BIGINT UNSIGNED NULL'
        );
    }

    public function down(): void
    {
        // Sengaja tidak mengubah kolom kembali menjadi NOT NULL
        // agar data yang memiliki nilai NULL tetap aman.
    }
};
