<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Serie;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('slug', 500);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('posted', ['yes', 'not'])->default('not');
            $table->timestamps();

            $table->foreignId('category_id')->constrained('categorias')
                  ->onDelete('cascade');
        });

        Schema::create('temporadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serie_id')->constrained('series')
                  ->onDelete('cascade');
            $table->string('title', 500);
            $table->integer('season_number');
            $table->timestamps();
        });

        Schema::create('capitulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temporada_id')->constrained('temporadas')
                  ->onDelete('cascade');
            $table->string('title', 500);
            $table->integer('episode_number');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitulos');
        Schema::dropIfExists('temporadas');
        Schema::dropIfExists('series');
    }
};
