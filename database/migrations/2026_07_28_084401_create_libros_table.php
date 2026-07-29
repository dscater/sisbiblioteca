<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro_inventario');
            $table->date('fecha_ingreso');
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('autor_id')->unsigned();
            $table->string('titulo', 255);
            $table->bigInteger('edicion_id')->unsigned();
            $table->bigInteger('volumen_id')->unsigned();
            $table->bigInteger('lugar_id')->unsigned();
            $table->bigInteger('editorial_id')->unsigned();
            $table->integer('fecha_anio');
            $table->integer('nro_paginas');
            $table->string('isbn');
            $table->text('descriptores');
            $table->text('resumen');
            $table->string('procedencia')->nullable();
            $table->decimal('precio', 24, 2)->nullable();
            $table->string('signatura');
            $table->string('estado');
            $table->string('portada', 255);
            $table->string('contraportada', 255);
            $table->string('tipo');
            $table->bigInteger('ubicacion_id')->unsigned();
            $table->string('portal', 20);
            $table->string('observaciones', 255)->nullable();
            $table->integer('vistos')->nullable();
            $table->date('fecha_registro');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas')->ondelete('no action')->onupdate('cascade');
            $table->foreign('autor_id')->references('id')->on('autors')->ondelete('no action')->onupdate('cascade');
            $table->foreign('edicion_id')->references('id')->on('edicions')->ondelete('no action')->onupdate('cascade');
            $table->foreign('volumen_id')->references('id')->on('volumens')->ondelete('no action')->onupdate('cascade');
            $table->foreign('lugar_id')->references('id')->on('lugars')->ondelete('no action')->onupdate('cascade');
            $table->foreign('editorial_id')->references('id')->on('editorials')->ondelete('no action')->onupdate('cascade');
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
