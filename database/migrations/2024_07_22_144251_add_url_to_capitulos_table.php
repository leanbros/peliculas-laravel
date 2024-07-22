<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('capitulos', function (Blueprint $table) {
            $table->string('url', 500)->after('episode_number'); // Puedes ajustar la posición de la columna según tu preferencia
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capitulos', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};
