<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReglasUsuarioCController;
use App\User;
use App\Regemp;
use App\Proveedores;


class ProvCController extends Controller
{
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

        //registros de Proveedor
        	$Proveedores=Proveedores::where('id_empresa','=',$id_empresa)->get();  


        $data = ['Tipo' => $tipo, 
            'Nivel'=> $Nivel,    
            'Usuario' => $Usuario, 
            'Texto' => $mensaje,
            'Empresa' => $Empresa,   
            'Seguridad' => $Seguridad,
            'Proveedores' => $Proveedores
        ]; 

         return view('Proveedores')->with('data',$data);
    }

    public function agregar(){

    	$id_empresa = request('id_empresa');; 
    	$nombre = request('txt_nombre');
    	$email = request('txt_email');
    	$telefono = request('txt_telefono');
    	$direccion = request('txt_direccion');


    	//verifica si existe los datos
			$registro = Proveedores::where('Nombre','=',$nombre)
		            ->orWhere('email','=',$email)
		            ->orWhere('telefono','=',$telefono)
		            ->get();
            if (count($registro)>0) {
            	$men = 'El nombre, email o teléfono ya existe en el sistema';
	            return $this->principal($men,'Error', $id_empresa);    
            }
        //Agregas el registro
            Proveedores::create([                
                'Nombre' => $nombre,
                'id_empresa' => $id_empresa,
                'email' => $email,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'habilitado' => 1
            ]);
    	return $this->principal('El proveedor ha sido registrado','OK', $id_empresa);
    }

    public function editar(){
    	$id_empresa = request('id_empresa');
    	$Proveedor = Proveedores::find(request('id'));                            
        $Proveedor->habilitado = request('habilitado');                
        $Proveedor->save();       
        return $this->principal('El proveedor ha sido registrado','OK', $id_empresa);
    }

    public function eliminar(){
    	$id_empresa = request('id_empresa');
    	$Proveedor = Proveedores::find(request('id'));
        $Proveedor->delete();
		return $this->principal('El proveedor ha sido Eliminado','OK', $id_empresa);
    }
}
