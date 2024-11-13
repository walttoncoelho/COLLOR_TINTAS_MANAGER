<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('dados_empresa', function (Blueprint $table) {
            $table->string('endereco')->nullable(); // Adiciona a coluna 'endereco'
        });
    }

    public function down()
    {
        Schema::table('dados_empresa', function (Blueprint $table) {
            $table->dropColumn('endereco'); // Remove a coluna 'endereco' se a migração for revertida
        });
    }
};
