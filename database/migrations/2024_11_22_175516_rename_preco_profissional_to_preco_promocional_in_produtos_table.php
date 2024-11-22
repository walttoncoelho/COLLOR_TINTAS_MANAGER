<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->renameColumn('preco_profissional', 'preco_promocional');
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->renameColumn('preco_promocional', 'preco_profissional');
        });
    }
};
