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
        Schema::table('dados_empresa', function (Blueprint $table) {
            $table->json('galeria_imagens')->nullable(); // Coluna para armazenar a galeria de imagens
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dados_empresa', function (Blueprint $table) {
            $table->dropColumn('galeria_imagens'); // Remove a coluna se a migração for revertida
        });
    }
};
