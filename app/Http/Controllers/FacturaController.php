<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReglasUsuarioCController;
use App\User;
use App\Regemp;
use App\Cc;
use App\Est_tran;
use App\Doc_tran;
use App\mess_tran;
use App\histran;
use Mail;
use App\UserEmp;

class FacturaController extends Controller{

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

        //Centros de costos habilitados
        $Cc = Cc::where('id_empresa','=',$id_empresa)
                            ->where('habilitado','=',1)
                            ->OrderBy('descripcion','Asc')
                            ->get();

        $Empresa=Regemp::where('id','=',$id_empresa)->get();       
        $data = ['Tipo' => $tipo,
        	'Cc' => $Cc, 
            'Nivel'=> $Nivel,    
            'Usuario' => $Usuario, 
            'Texto' => $mensaje,
            'Empresa' => $Empresa,   
            'Seguridad' => $Seguridad           
        ]; 

        return view('Factura')->with('data',$data);
    }

    public function Agregar(){

        //obtener Razon de Empresa
            $id_empresa = request('id_empresa');
            $Empresa = Regemp::where('id','=',$id_empresa)->get();
        //Obtener CC
            $id_cc = request('cc');
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
        //registro transacción
            $idTran = Est_tran::create([                
                'id_usuario' => Auth::id(),
                'id_empresa' => $id_empresa,
                'id_estado' => 1,
                'id_cc' => request('cc'),
                'tipo' => request('tipo')               
            ]);
        //agrega historico
            histran::create([                
                'id_tran' =>  $idTran['id'],       
                'id_usuario' => Auth::id(),         
                'id_estado' => 1,
                'descripcion' => 'Se crea la transacción'
                
            ]);
        //registros documento
            for ($i=0; $i < $tot_doc ; $i++) { 
                Doc_tran::create([               
                    'id_usuario' => Auth::id(),
                    'id_empresa' => $id_empresa,
                    'id_tran' => $idTran['id'],
                    'nombre' => $_FILES['doc']['name'][$i]
                ]);
                $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['doc']['name'][$i];
                move_uploaded_file($_FILES['doc']['tmp_name'][$i], $micarpeta);

            }
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
        return $this->principal('La factura ha sido registrada','OK', $id_empresa);
    }

    public function Masiva(){
        //usuario
            $Usuario = User::where('id','=',Auth::id())->get();
        //obtener Razon de Empresa
            $id_empresa = request('id_empresa');
            $Empresa = Regemp::where('id','=',$id_empresa)->get();
        //Obtener CC
            $id_cc = request('cc');
            $Cc = Cc::where('id','=',$id_cc)->get();
        //busca si existe el documento
            $reporte='Los siguientes archivos no se cargaron porque ya existian en el sistema: ';

            $tot_doc = count($_FILES['doc']['name'])-1;
            $mes = $Cc[0]['mes'];
             
            for ($i=0; $i <= $tot_doc ; $i++) { 
                $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['doc']['name'][$i];
                $men='';
               
                if (file_exists($micarpeta)) {
                   $reporte = $reporte . ' '. $_FILES['doc']['name'][$i];
                }else{
                    //registro transacción
                        $idTran = Est_tran::create([                
                            'id_usuario' => Auth::id(),
                            'id_empresa' => $id_empresa,
                            'id_estado' => 1,
                            'id_cc' => request('cc'),
                            'tipo' => request('tipo')               
                        ]);

                    //agrega historico
                        histran::create([                
                            'id_tran' =>  $idTran['id'],       
                            'id_usuario' => Auth::id(),         
                            'id_estado' => 1,
                            'descripcion' => 'Se crea la transacción'
                            
                        ]);


                    //registros documento
                        Doc_tran::create([               
                            'id_usuario' => Auth::id(),
                            'id_empresa' => $id_empresa,
                            'id_tran' => $idTran['id'],
                            'nombre' => $_FILES['doc']['name'][$i]
                        ]);

                        $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['doc']['name'][$i];
                        move_uploaded_file($_FILES['doc']['tmp_name'][$i], $micarpeta);

                    //Registro Comentario si existe

                        $Comentario = request('comen_'. $i);

                        if (!is_null($Comentario)) {
                            mess_tran::create([                    
                                'id_usuario' => Auth::id(),
                                'id_empresa' => $id_empresa,
                                'id_tran' => $idTran['id'],
                                'mensaje' => $Comentario
                            ]);
                        } 
                    //Documentos Auxiliares
                        $DocAux = request('docAux_'. $i);
                        if (!is_null($DocAux)) {
                            $tot_doc_aux = count($_FILES['docAux_'. $i]['name']);
                            for ($a=0; $a < $tot_doc_aux; $a++) { 

                            //verifica que exista
                                $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['docAux_'. $i]['name'][$i];

                                if (file_exists($micarpeta)) {
                                    $reporte = $reporte . ' '. $_FILES['docAux_'. $i]['name'][$i];
                                }else{

                                    Doc_tran::create([               
                                        'id_usuario' => Auth::id(),
                                        'id_empresa' => $id_empresa,
                                        'id_tran' => $idTran['id'],
                                        'nombre' => $_FILES['docAux_'. $i]['name'][$a]
                                    ]);

                                    $micarpeta = public_path().'/documentos/Temp/'.$Empresa[0]['Razon'].'/'.$mes.'/'.$_FILES['docAux_'. $i]['name'][$a];
                                    move_uploaded_file($_FILES['docAux_'. $i]['tmp_name'][$a], $micarpeta);
                                }
                            }
                        } 
                       
                }
            }

        //enviar emails            
             $DatosMail = ['Nombres' => $Usuario[0]['name'], 
                'Mensaje' => 'Este es un mensaje', 
                'Archivos' => $_FILES['doc']['name']
            ]; 

            $UsuarioEmail = $Usuario[0]['email'];      

            Mail::send('PlantillasEmails/EnvioFactura',$DatosMail, function($msj) use($UsuarioEmail){
                $msj->from('eberj.blanco@gmail.com',"ContableWork");
                $msj->subject('ContableWork');
                $msj->to($UsuarioEmail);
                $msj->cc('contador.ft@gmail.com');
                $msj->cc('eberj.blanco@hotmail.com');
            });

         return $this->principal('Las Facturas han sido registradas.('.$reporte.')','OK', $id_empresa);
    }

    public function Editar(){
    	
    }

    public function Eliminar(){
    	
    }
}
