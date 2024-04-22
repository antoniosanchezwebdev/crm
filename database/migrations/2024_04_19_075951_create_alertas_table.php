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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('estado_id')->nullable();
            $table->integer('tipo_id')->nullable();
            $table->integer('referencia_id')->nullable();
            $table->string('roles')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('titulo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alertas');
    }
};
