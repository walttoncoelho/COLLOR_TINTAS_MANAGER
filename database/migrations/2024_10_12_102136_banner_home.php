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
        Schema::create('banner_home', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Campo para o título
            $table->integer('ordem'); // Campo para a ordem de exibição (1 a 6)
            $table->string('banner_desktop'); // Caminho para o arquivo do banner desktop
            $table->string('banner_mobile'); // Caminho para o arquivo do banner mobile
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_home');
    }
};
