<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuridicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridicas', function (Blueprint $table) {
            $table->id();
            $table->string('Nit');
            $table->string('Razon');
            //nuevos campos agregados
            $table->string('Departamento');
            $table->string('Municipio');
            $table->string('Direccion');
            $table->string('Correo');
            //$table->string('Logo');
            $table->string('Telefono');
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
        Schema::dropIfExists('juridicas');
    }
}
