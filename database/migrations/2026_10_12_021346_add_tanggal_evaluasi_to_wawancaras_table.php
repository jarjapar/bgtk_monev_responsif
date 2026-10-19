
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('wawancaras', 'tanggal_evaluasi')) {
            Schema::table('wawancaras', function (Blueprint $table) {
                $table->date('tanggal_evaluasi')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('wawancaras', 'tanggal_evaluasi')) {
            Schema::table('wawancaras', function (Blueprint $table) {
                $table->dropColumn('tanggal_evaluasi');
            });
        }
    }
};
