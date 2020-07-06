<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprobantes;
use App\Regemp;
use App\Cc;

class ComproCController extends Controller{



    public function guardar(){

        $tabla1 = request('tabla');
        $id_empresa = request('id_empresa');
    	
    	$array = json_decode($tabla1);
        $registrosExistentes=0;
        $registrosagregados=0;
        $cecosInexistentes ='';
       
    	foreach ($array as $value) {
            //busque si existe el registro	
    		  	$Registro = Comprobantes::where('CodCompro','=',$value[5])
                            ->Where('CtaConta','=',$value[7])
                            ->Where('NroDoc','=',$value[6])
                            ->Where('DebCre','=',$value[8])
                            ->get();
                if (count($Registro)==1) {                     
                     $registrosExistentes = $registrosExistentes + 1;
                     continue;
                }

            //Busca si existe el CECO
                $Registro = Cc::where('codigo','=',trim($value[2]).'-'.trim($value[11]))
                            ->Where('id_empresa','=',$id_empresa)
                            ->get();
                if (count($Registro)==0) {                     
                     $cecosInexistentes = $cecosInexistentes.trim($value[2]).'-'.trim($value[11]) .',';
                     continue;
                }

            //agregas los registros
                Comprobantes::create([
                    'FecDoc'=> trim($value[0]),
                    'Nit'=>  trim($value[1]), 
                    'Ceco'=> trim($value[2]), 
                    'DescSec'=>  trim($value[3]), 
                    'TpoCompro'=> trim($value[4]), 
                    'CodCompro'=>trim($value[5]), 
                    'NroDoc'=> trim($value[6]), 
                    'CtaConta'=>trim($value[7]), 
                    'DebCre'=> trim($value[8]), 
                    'ValSec'=> trim($value[9]), 
                    'Secuencia'=> trim($value[10]),
                    'SubCeco'=>trim($value[11]), 
                    'ComproAnu'=> trim($value[12]), 
                    'BaseReten'=>trim($value[13]), 
                    'GrupoAct'=> trim($value[14]), 
                    'CodAct'=> trim($value[15]), 
                    'NroDocProvee'=> trim($value[16]), 
                    'PrefDocProvee'=> trim($value[17]), 
                    'FecDocProvee'=>  trim($value[18]), 
                    'TpoComproCruce'=> trim($value[19]), 
                    'NroDocCruce'=> trim($value[20]), 
                    'FecDocCruce'=> trim($value[21])
                ]);

                $registrosagregados = $registrosagregados + 1;
                           
		}      

        $respuesta = ['registrosagregados' => $registrosagregados, 
            'registrosExistentes' => $registrosExistentes,    
            'cecosInexistentes' =>$cecosInexistentes,
            'Status' => 'Ok'
        ];

        return json_encode($respuesta); 
    }
}
