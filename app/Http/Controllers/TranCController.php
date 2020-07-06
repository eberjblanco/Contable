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

class TranCController extends Controller{   

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
                                ->where('id_estado','=',1)
                                ->get();
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
                'Comentarios' => $Comentarios
            ];
            
        return view('Tran')->with('data',$data);
    }

     public function buscar(){
        $id_empresa = request('id_empresa');
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
            $tipo ='';
            $mensaje='';
            $Empresa=Regemp::where('id','=',$id_empresa)->get();  

        //Transacciones

        $filtro = request('tipo');
        switch ($filtro) {
            case 'cc':
                $Registros=Est_tran::where('id_cc','=',request('cc'))
                                    ->where('id_empresa','=',$id_empresa)
                                    ->get();
                break;
            case 'T':
                $Registros=Est_tran::where('id','=',request('txt_T'))
                                    ->where('id_empresa','=',$id_empresa)
                                    ->get();
                break;
                // ->whereBetween('fecha_emision', [$f1, $f2])
            case 'Fecha':                
                $fechaRan  = request('txt_Fecha');
                $fec_exp = explode("-", $fechaRan);               
                $Registros=Est_tran::whereBetween('created_at',[$fec_exp[0].' 01:00:00' , $fec_exp[1].' 23:00:00'])
                                    ->where('id_empresa','=',$id_empresa)
                                    ->get();
                break;
            
            default:
                # code...
                break;
        }

        $data = ['Tipo' => $tipo, 
            'Registros' => $Registros,
            'Nivel'=> $Nivel,    
            'Usuario' => $Usuario, 
            'Texto' => $mensaje,
            'Empresa' => $Empresa,   
            'Seguridad' => $Seguridad,
              
        ];

        //retorna vista
        return view('ResulTran')->with('data',$data);
    }    

    public function Contabilizacion(){
        $reg = request('countReg');

        for ($i=1; $i <= $reg; $i++) { 
            if (isset($_POST['id_tran_'.$i])) {
                //agregas los registros a la tabla conta
                   Conta::create([                
                        'id_tran'=> request('id_tran_'.$i),           
                        'fecha'=> request('fecha_'.$i).'-'. request('num_'.$i),             
                    ]);
                //editas en la tabla est_tran
                    $ActEst = Est_tran::find(request('id_tran_'.$i));
                    $ActEst->update([
                        'id_estado' => 2
                    ]);
                //registras el historial
                    histran::create([                
                        'id_tran'=> request('id_tran_'.$i),           
                        'id_estado'=> 2,  
                        'id_usuario'=> Auth::id(),  
                        'descripcion'=> 'Se envio la transacción a Contabilización',  
                    ]);

            }                
        } 

        return $this->principal('Las transacciones se enviaron a Contabilización','OK',request('id_empresa'));

    }

    public function VerificarArchivo(){
        $archivo = request('archivo');
        $Registro = Doc_tran::where('nombre','=',$archivo)
                        ->get();
        $numReg= count($Registro);
        if ($numReg>0) {
            $data['respuesta'] = 'Si';
        }else{
            $data['respuesta'] = 'No';
        }

        echo json_encode($data);
    }

    public function AgregarArchivo(){
       
    }
}
