
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bcks_pengisians', function (Blueprint $table) {
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();
        });

        Schema::table('bk_submissions', function (Blueprint $table) {
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();
        });

        Schema::table('tendiks', function (Blueprint $table) {
            $table->foreignId('sekolah_id')
                ->nullable()
                ->constrained('sekolahs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tendiks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sekolah_id');
        });

        Schema::table('bk_submissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sekolah_id');
        });

        Schema::table('bcks_pengisians', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sekolah_id');
        });
    }
};
