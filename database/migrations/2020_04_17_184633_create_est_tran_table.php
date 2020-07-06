<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstTranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('est_tran', function (Blueprint $table) {
            $table->id();           
            $table->double('id_usuario');
            $table->double('id_empresa');
            $table->double('id_estado');
            $table->double('id_cc');
            $table->string('tipo');            
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
        Schema::dropIfExists('est_tran');
    }
}
