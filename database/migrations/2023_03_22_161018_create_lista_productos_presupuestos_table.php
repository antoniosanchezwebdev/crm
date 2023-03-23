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
        Schema::create('linea_productos_presupuestos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_presupuesto')->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('pvp')->nullable();
            $table->decimal('descuento')->nullable();
            $table->decimal('ecotasa')->nullable();
            $table->decimal('total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_productos_presupuestos');
    }
};
