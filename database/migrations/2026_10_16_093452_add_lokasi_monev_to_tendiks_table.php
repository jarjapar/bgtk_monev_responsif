<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tendiks', function (Blueprint $table) {
            if (! Schema::hasColumn('tendiks', 'lokasi_monev')) {
                $table->string('lokasi_monev')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tendiks', function (Blueprint $table) {
            if (Schema::hasColumn('tendiks', 'lokasi_monev')) {
                $table->dropColumn('lokasi_monev');
            }
        });
    }
};