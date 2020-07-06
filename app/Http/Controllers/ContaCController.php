<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReglasUsuarioCController;
use App\User;
use App\Regemp;
use App\Cc;
use App\Proveedores;
use App\Est_tran;
use App\Doc_tran;
use App\mess_tran;
use App\Conta;
use App\histran;
use App\Comprobantes;
use App\CompTran;
use App\Observaciones;

class ContaCController extends Controller
{
    //
    public function index(){
    	 return $this->principal('','',request('id_empresa'));
    }

     public function principal($mensaje,$tipo,$id_empresa){
        //Evalua Seguridad
            $ReglasUsuario = new ReglasUsuarioCController;
            $Seguridad = $ReglasUsuario->show(Auth::id(),$id_empresa);
            $Usuario = User::where('id','=',Auth::id())->get();
            $Nivel = $Usuario[0]['SuperAdmin'];
            if ($Nivel==0) {
                $Nivel = UserEmp::where('id_usuario','=',Auth::id())
                                ->where('id_empresa','=',$id_empresa)
                                ->get('id_nivel')[0]['id_nivel'];
            }  
        //datos de empresa
            $Empresa=Regemp::where('id','=',$id_empresa)->get();
        //Centros de costos habilitados
            $Cc = Cc::where('id_empresa','=',$id_empresa)
                            ->where('habilitado','=',1)
                            ->OrderBy('descripcion','Asc')
                            ->get();
        //Proveedores
            $Proveedores=Proveedores::where('id_empresa','=',$id_empresa)
                            ->OrderBy('Nombre','Asc')
                            ->get();
        //Documentos
            $Documentos=Doc_tran::where('id_empresa','=',$id_empresa)
                            ->get();  
        //Comentarios
            $Comentarios=mess_tran::where('id_empresa','=',$id_empresa)                            
                            ->get();
        //Datos sin filtro
            $Registros=Est_tran::where('id_empresa','=',$id_empresa)
                                ->where('id_estado','=',2)
                                ->get();
        

        //Fecha de Contabilizaciones
            $Conta=Conta::get();

        //Comprobantes
            $Comprobantes = Comprobantes::get();

            $data = ['Tipo' => $tipo,    
                'Cc' => $Cc,        
                'Nivel'=> $Nivel,    
                'Usuario' => $Usuario, 
                'Texto' => $mensaje,
                'Empresa' => $Empresa,   
                'Seguridad' => $Seguridad,
                'Proveedores' => $Proveedores,
                'Registros' => $Registros,
                'Documentos' => $Documentos,
                'Comentarios' => $Comentarios,
                'Conta' => $Conta,
                'Comprobantes' => $Comprobantes
            ];
        return view('Contabilizacion')->with('data',$data);
    }

    public function AgregarTranDoc(){

        //obtener Razon de Empresa
            $id_empresa = request('id_empresa');
            $Empresa = Regemp::where('id','=',$id_empresa)->get();
        //Obtener CC
            $id_cc = request('id_cc');
            $Cc = Cc::where('id','=',$id_cc)->get();
        //busca si existe el documento
            $tot_doc = count($_FILES['doc']['name']);
            $mes = $Cc[0]['mes'];
            for ($i=0; $i < $tot_doc - 1; $i++) { 
                $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['doc']['name'][$i];
                $men='';
                if (file_exists($micarpeta)) {
                   return $this->principal('El Documento '.$_FILES['doc']['name'][$i].'  ya existe en el mes '.$mes,'Error', $id_empresa);        
                }
            }
        //verificas estado al que va
            $tpocompro = request('r1');
            switch ($tpocompro) {
                case 'pagar':
                    $est = 3;
                    break;
                case 'cobrar':
                    $est = 4;
                    break;
                case 'archivar':
                    $est = 6;
                    break;
            }
        //verificas si es egreso,ingreso u otro
            $tipoReq = request('tipo');
            $tipo = "O";
            if ($tipoReq=='F' || $tipoReq=='R') {
               $tipo = "I";
            }
            if ($tipoReq=='P' || $tipoReq=='G') {
               $tipo = "G";
            }

        //registro transacción
            $idTran = Est_tran::create([                
                'id_usuario' => Auth::id(),
                'id_empresa' => $id_empresa,
                'id_estado' => $est,
                'id_cc' => request('id_cc'),
                'tipo' => $tipo               
            ]);
        //agrega historico
            histran::create([                
                'id_tran' =>  $idTran['id'],       
                'id_usuario' => Auth::id(),         
                'id_estado' => $est,
                'descripcion' => 'Se crea la transacción en contabilización'
                
            ]);
        //registros documento
          
                Doc_tran::create([               
                    'id_usuario' => Auth::id(),
                    'id_empresa' => $id_empresa,
                    'id_tran' => $idTran['id'],
                    'nombre' => $_FILES['doc']['name'][0]
                ]);
                $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['doc']['name'][0];
                move_uploaded_file($_FILES['doc']['tmp_name'][$i], $micarpeta);

            
        //Registro Comentario si existe
            $Comentario = request('comentario');
            if (!is_null($Comentario)) {
                mess_tran::create([                    
                    'id_usuario' => Auth::id(),
                    'id_empresa' => $id_empresa,
                    'id_tran' => $idTran['id'],
                    'mensaje' => $Comentario
                ]);
            }     

        //realizas la Relación     
            CompTran::create([
                'id_tran' => $idTran['id'],
                'id_comp'=> request('id_comp')
            ]);

         //Registro Observaciones si existe
            $observaciones = request('observaciones');
            if (!is_null($observaciones)) {
                Observaciones::create([                    
                    'id_tran' => $idTran['id'],
                    'id_usuario' => Auth::id(),                
                    'observaciones' => $observaciones
                ]);
            }    


        return $this->principal('La Relación ha sido registrada','OK', $id_empresa);
    }

    public function AgregarTranSiigo(){

         $id_empresa = request('id_empresa');

        //verificas estado al que va
            $tpocompro = request('r1');
            switch ($tpocompro) {
                case 'pagar':
                    $est = 3;
                    break;
                case 'cobrar':
                    $est = 4;
                    break;
                case 'archivar':
                    $est = 6;
                    break;
            }
        //verificas si es egreso,ingreso u otro
            $tipoReq = request('tipo');
            $tipo = "O";
            if ($tipoReq=='F' || $tipoReq=='R') {
               $tipo = "I";
            }
            if ($tipoReq=='P' || $tipoReq=='G') {
               $tipo = "G";
            }

        //registro transacción
            $registro = Est_tran::find(request('txtTranRelId'));
            $registro->id_estado = $est;
            $registro->save();          

        //agrega historico
            histran::create([                
                'id_tran' =>  request('txtTranRelId'),       
                'id_usuario' => Auth::id(),         
                'id_estado' => $est,
                'descripcion' => 'Se crea la transacción en contabilización'
                
            ]);
       

            
        //Registro Comentario si existe
            $Comentario = request('comentario');
            if (!is_null($Comentario)) {
                mess_tran::create([                    
                    'id_usuario' => Auth::id(),
                    'id_empresa' => $id_empresa,
                    'id_tran' => request('txtTranRelId'),
                    'mensaje' => $Comentario
                ]);
            }     

        //realizas la Relación     
            CompTran::create([
                'id_tran' => request('txtTranRelId'),
                'id_comp'=> request('txtDocNum')
            ]);

        //Registro Observaciones si existe
            $observaciones = request('observaciones');
            if (!is_null($observaciones)) {
                Observaciones::create([                    
                    'id_tran' => request('txtTranRelId'),
                    'id_usuario' => Auth::id(),                
                    'observacion' => $observaciones
                ]);
            }   


        return $this->principal('La Relación ha sido registrada','OK', $id_empresa);
        
    }

 
}
