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
        Schema::table('banner_home', function (Blueprint $table) {
            $table->string('link')->nullable()->after('titulo');
            $table->boolean('status')->default(true)->after('link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banner_home', function (Blueprint $table) {
            $table->dropColumn(['link', 'status']);
        });
    }
};