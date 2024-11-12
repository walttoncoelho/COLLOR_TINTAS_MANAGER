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
        // Criação da tabela "produtos"
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->text('descricao');
            $table->decimal('preco', 10, 2); // Exemplo para armazenar preço com duas casas decimais
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade'); // Relacionamento com a tabela categorias
            $table->boolean('outros_materiais')->default(false); // Campo booleano
            $table->boolean('destaque')->default(false); // Campo booleano
            $table->boolean('linha_industrial')->default(false); // Novo campo booleano "Linha Industrial"
            $table->timestamps();
        });

        // Criação da tabela de relação "produtos_similares"
        Schema::create('produtos_similares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->foreignId('produto_similar_id')->constrained('produtos')->onDelete('cascade');
            $table->timestamps();
        });

        // Criação da tabela "produto_imagens" para armazenar múltiplas imagens por produto
        Schema::create('produto_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade'); // Relacionamento com produtos
            $table->string('caminho'); // Caminho da imagem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_imagens'); // Remover tabela de imagens
        Schema::dropIfExists('produtos_similares');
        Schema::dropIfExists('produtos');
    }
};
