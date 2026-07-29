<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_prestamos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codigo');
            $table->bigInteger('libro_id')->unsigned();
            $table->bigInteger('lector_id')->unsigned();
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_fin');
            $table->text('observacion')->nullable();
            $table->date('fecha_registro');
            $table->string('estado_solicitud');
            $table->timestamps();

            $table->foreign('libro_id')->references('id')->on('libros')->ondelete('no action')->onupdate('cascade');
            $table->foreign('lector_id')->references('id')->on('lectors')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_prestamos');
    }
}
