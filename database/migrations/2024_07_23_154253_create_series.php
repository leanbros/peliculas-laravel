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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_serie',500);
            $table->text('descripcion')->nullable();
            $table->string('fecha_de_lanzamiento',500);
            $table->string('imagen')->nullable();
            $table->enum('posted',['yes','not'])->default('not');
            $table->timestamps();
            

            $table->foreignId('category_id')->constrained('categories')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
