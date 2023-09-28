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
        Schema::create('entrada_salidas', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->integer('cantidad');
            $table->float('valor');
            $table->integer('cantidad_total');
            $table->float('valor_total');
            $table->float('valor_unit');
            $table->string('tipo');
            $table->unsignedBigInteger('producto_id');          
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salidas');
    }
};