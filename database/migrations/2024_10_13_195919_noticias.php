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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->string('autor')->default('Desconhecido'); // Define um valor padrão

            $table->string('imagem');
            $table->text('conteudo');
            $table->date('data_publicacao');
            $table->date('data_arquivamento')->nullable();
            $table->enum('status', ['Publicado', 'Rascunho', 'Revisão', 'Arquivado']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
