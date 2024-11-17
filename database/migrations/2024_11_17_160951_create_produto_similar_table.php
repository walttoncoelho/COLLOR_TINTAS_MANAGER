<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produto_similar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('similar_id');
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('produto_id')
                  ->references('id')
                  ->on('produtos')
                  ->onDelete('cascade');

            $table->foreign('similar_id')
                  ->references('id')
                  ->on('produtos')
                  ->onDelete('cascade');

            // Garante que não haja duplicatas
            $table->unique(['produto_id', 'similar_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto_similar');
    }
};