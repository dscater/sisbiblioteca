<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nombre',255);
            $table->string('apellidos');
            $table->string('ci');
            $table->string('ci_exp');
            $table->string('cel');
            $table->string('dir');
            $table->string('correo',255);
            $table->string('contrasenia',255);
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectors');
    }
}
