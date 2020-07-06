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
            $table->double('CodCompro');
            $table->double('NroDoc');

            $table->string('CtaConta');
            $table->string('DebCre');
            $table->double('ValSec');
            $table->string('FecDoc');
            $table->double('Secuencia');
            $table->string('Ceco');
            $table->double('SubCeco');
            $table->string('Nit');
            $table->string('DescSec');
            $table->string('ComproAnu');

            $table->double('BaseReten');
            $table->double('GrupoAct');
            $table->double('CodAct');
            $table->double('NroDocProvee');
            $table->string('PrefDocProvee');
            $table->string('FecDocProvee');
            $table->double('TpoComproCruce');
            $table->double('NroDocCruce');
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
