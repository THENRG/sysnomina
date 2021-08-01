<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
			$table->string('name');
			$table->string('email');
            $table->string('genero');
            $table->string('contacto');
            $table->string('profesion');
            $table->string('fecha_nacimiento');
            $table->string('direccion');
            $table->string('rif');
            $table->string('cargo');
            $table->string('horario');
            $table->string('dpto');
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
        Schema::dropIfExists('employees');
    }
}
