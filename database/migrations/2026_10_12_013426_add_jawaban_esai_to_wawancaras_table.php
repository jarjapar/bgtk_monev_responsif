
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            $table->longText('jawaban_1')->nullable();
            $table->longText('jawaban_2')->nullable();
            $table->longText('jawaban_3')->nullable();
            $table->longText('jawaban_4')->nullable();
            $table->longText('jawaban_5')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            $table->dropColumn([
                'jawaban_1',
                'jawaban_2',
                'jawaban_3',
                'jawaban_4',
                'jawaban_5',
            ]);
        });
    }
};
