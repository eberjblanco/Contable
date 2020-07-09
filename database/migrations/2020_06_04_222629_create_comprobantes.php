<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();            
            $table->string('TpoCompro');
            $table->string('CodCompro');
            $table->string('NroDoc');

            $table->string('CtaConta');
            $table->string('DebCre');
            $table->string('ValSec');
            $table->string('FecDoc');
            $table->string('Secuencia');
            $table->string('Ceco');
            $table->string('SubCeco');
            $table->string('Nit');
            $table->string('DescSec');
            $table->string('ComproAnu');

            $table->string('BaseReten');
            $table->string('GrupoAct');
            $table->string('CodAct');
            $table->string('NroDocProvee');
            $table->string('PrefDocProvee');
            $table->string('FecDocProvee');
            $table->string('TpoComproCruce');
            $table->string('NroDocCruce');
            $table->string('FecDocCruce');


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
        Schema::dropIfExists('comprobantes');
    }
}
