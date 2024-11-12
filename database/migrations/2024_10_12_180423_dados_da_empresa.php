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
        Schema::create('dados_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('email_comercial')->nullable(); // Campo de e-mail comercial
            $table->string('telefone_comercial')->nullable(); // Campo de telefone comercial
            $table->string('whatsapp')->nullable(); // Campo de WhatsApp
            $table->string('instagram')->nullable(); // Link do Instagram
            $table->string('facebook')->nullable(); // Link do Facebook
            $table->text('localizacao')->nullable(); // Tag do Google Maps
            $table->timestamps(); // Campos de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_empresa');
    }
};
