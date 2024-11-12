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
        Schema::create('sobre_empresa', function (Blueprint $table) {
            $table->id();
            $table->text('sobre_empresa')->nullable(); // Campo de descrição sobre a empresa, não obrigatório
            $table->string('imagem')->nullable(); // Campo de imagem, não obrigatório
            $table->text('missao')->nullable(); // Campo de missão, não obrigatório
            $table->text('visao')->nullable(); // Campo de visão, não obrigatório
            $table->text('valores')->nullable(); // Campo de valores, não obrigatório
            $table->timestamps(); // Campos para created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sobre_empresa');
    }
};
