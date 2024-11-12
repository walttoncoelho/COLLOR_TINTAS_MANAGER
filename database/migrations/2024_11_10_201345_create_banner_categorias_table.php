
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('banner_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->unsignedTinyInteger('ordem');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->timestamps();
        });

        // Tabela de relacionamento entre banner_categorias e categorias
        Schema::create('banner_categoria_categoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_categoria_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_categoria_categoria');
        Schema::dropIfExists('banner_categorias');
    }
};

