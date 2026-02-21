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
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('tipo_documento')->nullable()->change();
            $table->string('numero_documento')->nullable()->change();
            $table->string('direccion')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('tipo_documento')->nullable(false)->change();
            $table->string('numero_documento')->nullable(false)->change();
            $table->string('direccion')->nullable(false)->change();
        });
    }
};
