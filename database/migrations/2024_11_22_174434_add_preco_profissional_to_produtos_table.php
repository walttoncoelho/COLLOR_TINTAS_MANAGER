<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('preco_profissional', 10, 2)->nullable()->after('preco');
        });
    }
    
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('preco_profissional');
        });
    }
    
};
