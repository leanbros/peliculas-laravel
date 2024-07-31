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
        Schema::create('capitulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('temporada_id'); //clave foranea
            $table->string('titulo',500);
            $table->string('numero_capitulo',500);
            $table->string('url',500);
            $table->timestamps();

            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitulos');
    }
};
