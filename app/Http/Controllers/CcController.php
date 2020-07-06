<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Regemp;
use App\Http\Controllers\ReglasUsuarioCController;
use App\User;
use App\Cc;
use App\Http\Controllers\DocumentosCController;


class CcController extends Controller
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
        $CC = Cc::where('id_empresa','=',$id_empresa)->get(); 
        $Empresa=Regemp::where('id','=',$id_empresa)->get();       
        $data = ['Usuario' => $Usuario, 
            'Texto' => $mensaje,
            'Empresa' => $Empresa,   
            'Seguridad' => $Seguridad,
            'Tipo' => $tipo,
            'CC' => $CC
        ]; 

        return view('Cc')->with('data',$data);
    }

    public function Agregar(){
        try{

           

            
            $CC = Cc::where('descripcion','=',request('nombre'))->get();
            if (count($CC) > 0) {
                $men = 'El Centro de Costo ya existe en el sistema';
                return $this->principal($men,'Error',request('id_empresa'));

            }else{ 
                //obtener Razon de Empresa
                    $Empresa = Regemp::where('id','=',request('id_empresa'))->get();
                //verifica que sea todo el año
                if (request('mes') == 0) {

                    for ($i=1; $i < 13; $i++) { 
                        Cc::create([
                            'id_empresa'=> request('id_empresa'),
                            'descripcion'=> request('nombre'),
                            'habilitado'=> request('habilitado'),
                            'año'=> request('año'),
                            'mes'=> $i,
                        ]);

                        //creas el arbol de carpetas
                        $micarpeta = public_path().'/documentos/'.request('año').'/'.$i.'/'. $Empresa[0]['Razon'].'/'.request('nombre');
                        if (!file_exists($micarpeta)) {                    
                            mkdir($micarpeta, 0777, true);
                            mkdir($micarpeta.'/Bancos/', 0777, true);
                            mkdir($micarpeta.'/Factura de Ventas/', 0777, true);
                            mkdir($micarpeta.'/Factura de Ventas/Efectivo', 0777, true);
                            mkdir($micarpeta.'/Factura de Ventas/Banco', 0777, true);
                            mkdir($micarpeta.'/Factura de Ventas/Credito', 0777, true);
                            mkdir($micarpeta.'/Recibo de Caja', 0777, true);
                            mkdir($micarpeta.'/Comprobante Egreso', 0777, true);
                            mkdir($micarpeta.'/Factura de Compras/', 0777, true);
                            mkdir($micarpeta.'/Factura de Compras/Efectivo', 0777, true);
                            mkdir($micarpeta.'/Factura de Compras/Banco', 0777, true);
                            mkdir($micarpeta.'/Factura de Compras/Credito', 0777, true);
                            mkdir($micarpeta.'/Nominas', 0777, true);
                            mkdir($micarpeta.'/Otros', 0777, true);
                        }
                    }
                }else{

                    Cc::create([
                        'id_empresa'=> request('id_empresa'),
                        'codigo'=> request('cod'),
                        'descripcion'=> request('nombre'),
                        'habilitado'=> request('habilitado'),
                        'año'=> request('año'),
                        'mes'=> request('mes'),
                    ]);

                    //creas el arbol de carpetas
                    $micarpeta = public_path().'/documentos/'.request('año').'/'.request('mes').'/'. $Empresa[0]['Razon'].'/'.request('nombre');
                    if (!file_exists($micarpeta)) {                    
                        mkdir($micarpeta, 0777, true);
                        mkdir($micarpeta.'/Bancos/', 0777, true);
                        mkdir($micarpeta.'/Factura de Ventas/', 0777, true);
                        mkdir($micarpeta.'/Factura de Ventas/Efectivo', 0777, true);
                        mkdir($micarpeta.'/Factura de Ventas/Banco', 0777, true);
                        mkdir($micarpeta.'/Factura de Ventas/Credito', 0777, true);
                        mkdir($micarpeta.'/Recibo de Caja', 0777, true);
                        mkdir($micarpeta.'/Comprobante Egreso', 0777, true);
                        mkdir($micarpeta.'/Factura de Compras/', 0777, true);
                        mkdir($micarpeta.'/Factura de Compras/Efectivo', 0777, true);
                        mkdir($micarpeta.'/Factura de Compras/Banco', 0777, true);
                        mkdir($micarpeta.'/Factura de Compras/Credito', 0777, true);
                        mkdir($micarpeta.'/Nominas', 0777, true);
                        mkdir($micarpeta.'/Otros', 0777, true);
                    }
                }

                $men = 'El Centro de Costo se ha Registrado';
                return $this->principal($men,'OK',request('id_empresa'));
                
            }            
        } catch (Exception $e) {

            return $e;
            
        }        
    }

    public function Editar(){
         try{

           

            $CC = Cc::find(request('id'));                            
            $CC->habilitado = request('habilitado');                
            $CC->save();
            $men = 'El Centro de Costo se ha Modificado';
            return $this->principal($men,'OK',request('id_empresa'));


        } catch (Exception $e) {

            return $e;
            
        }    
    }

    public function Eliminar(){

        //obtener Razon de Empresa
            $Empresa = Regemp::where('id','=',request('id_empresa'))->get();

        

        //eliminar carpeta
         $target_path = public_path().'/documentos/'.request('año').'/'.request('mes').'/'.$Empresa[0]['Razon'].'/'.request('ruta').'/'; 

        if(is_dir($target_path)) {
                //eliminas ficheros si existen
                $files = glob($target_path.'/*'); //obtenemos todos los nombres de los ficheros
                foreach($files as $file){
                    if(is_file($file))
                    unlink($file); //elimino el fichero
                }
                //verificas que no haya subcarpetas o archivos dentro
               
                $objects = scandir($target_path);     
                $seg =0;          
                foreach ($objects as $object){
                    $seg=$seg + 1;
                } 
                
                if ($seg > 2) {
                    return $this->principal('Error al eliminar la carpeta. Revise que la carpeta este vacía','Error',request('id_empresa'));
                }else{
                    //eliminas carpeta
                    if (rmdir($target_path)) {
                        return $this->principal('Carpeta Eliminada','OK',request('id_empresa'));
                    }else{
                        return $this->principal('Error al eliminar la carpeta.','Error',request('id_empresa'));
                    }
                }                          
            }

        $CC = Cc::find(request('id'));
        $CC->delete();

        $men = 'El Centro de Costo se ha Eliminado';
        return $this->principal($men,'OK',request('id_empresa'));



    }
}
