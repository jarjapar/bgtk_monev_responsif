
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan relasi sekolah pada pengisian GEMBIRA.
     */
    public function up(): void
    {
        Schema::table('gembira_pengisians', function (Blueprint $table) {
            if (!Schema::hasColumn('gembira_pengisians', 'sekolah_id')) {
                $table->foreignId('sekolah_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('sekolahs')
                    ->nullOnDelete();
            }
        });
    }

    /**
     * Menghapus relasi sekolah dari pengisian GEMBIRA.
     */
    public function down(): void
    {
        Schema::table('gembira_pengisians', function (Blueprint $table) {
            if (Schema::hasColumn('gembira_pengisians', 'sekolah_id')) {
                $table->dropConstrainedForeignId('sekolah_id');
            }
        });
    }
};
