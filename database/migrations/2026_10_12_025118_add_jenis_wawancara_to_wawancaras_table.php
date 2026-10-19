
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('wawancaras', 'jenis_wawancara')) {
            Schema::table('wawancaras', function (Blueprint $table) {
                $table->string('jenis_wawancara', 20)
                    ->nullable()
                    ->after('id')
                    ->index();
            });
        }
    }

    public function down(): void
    {
        /*
         * Kolom ini berisi klasifikasi jenis wawancara.
         * Sebelum rollback, pastikan data jenis wawancara
         * sudah dicadangkan jika ingin mempertahankannya.
         */
        if (Schema::hasColumn('wawancaras', 'jenis_wawancara')) {
            Schema::table('wawancaras', function (Blueprint $table) {
                $table->dropIndex(['jenis_wawancara']);
                $table->dropColumn('jenis_wawancara');
            });
        }
    }
};
