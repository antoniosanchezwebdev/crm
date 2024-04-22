<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('proveedores_id')->nullable();
            $table->integer('productos_id')->nullable();
            $table->integer('cantidad')->nullable();
            $table->date('fecha_pedido')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->string('archivo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
