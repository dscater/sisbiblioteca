<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('libro_id')->unsigned();
            $table->bigInteger('solicitud_id')->unsigned()->nullable();
            $table->bigInteger('lector_id')->unsigned()->nullable();
            $table->string('tipo');
            $table->text('observaciones')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_registro');
            $table->date('fecha_devolucion')->nullable();
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('prestamos');
    }
}
