<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Regemp;
use App\UserEmp;
use App\Cc;
use App\Http\Controllers\ReglasUsuarioCController;
use App\User;
$id_empresa='';



class DocumentosCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $ruta = request('ruta');
        return $this->principal('','',request('id_empresa'),request('año'),request('mes'),$ruta);
     
    }

    public function principal($mensaje,$tipo,$id_empresa,$año,$mes,$ruta){
        

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

        //crear arbol       
        $this->crear_arbol($id_empresa);
        
        //obtener datos
        $contenido = $this->obtener_datos($id_empresa,$ruta);        

        $Empresa=Regemp::where('id','=',$id_empresa)->get();       
        $data = ['contenido' => $contenido, 
            'Tipo' => $tipo, 
            'Nivel'=> $Nivel,    
            'Usuario' => $Usuario, 
            'Texto' => $mensaje,
            'Empresa' => $Empresa,   
            'Seguridad' => $Seguridad,
            'año' => $año,
            'mes' => $mes,
            'ruta' => $ruta
        ]; 
        return view('DocEmp')->with('data',$data);
    }

    

    public function obtener_datos($id_empresa,$ruta){
        //obtener Razon de Empresa
            $Empresa = Regemp::where('id','=',$id_empresa)->get();
        $directorio = public_path().'/documentos/'.request('año').'/'.request('mes').'/'.$Empresa[0]['Razon'].'/'.$ruta;      
        $contenido  = scandir($directorio);         
        return json_encode($contenido);
    }

    public function crear_arbol($id_empresa){
        try {

            //obtener Razon de Empresa
                $Empresa = Regemp::where('id','=',$id_empresa)->get();
            //obtener CC de empresa
                $Cc = Cc::where('id_empresa','=',$id_empresa)->get();
            foreach ($Cc as $ItemCc ) {
                //revisa si existe carpeta
                $micarpeta = public_path().'/documentos/'.request('año').'/'.request('mes').'/'. $Empresa[0]['Razon'].'/'.$ItemCc->descripcion;
                if (!file_exists($micarpeta)) {
                    //crea estructura Primera Vez
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
            return $Cc;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function CrearCarpeta(){
        try {
            //obtener Razon de Empresa
                $Empresa = Regemp::where('id','=',request('id_empresa'))->get();

            $micarpeta = public_path().'/documentos/'.request('año').'/'.request('mes').'/' .$Empresa[0]['Razon'].'/'.request('ruta').'/'.request('nombre');
           if (!file_exists($micarpeta)) {
                mkdir($micarpeta, 0777, true);        
            }
            return $this->principal('Carpeta Creada','OK',request('id_empresa'),request('año'),request('mes'),request('ruta'));
          
        } catch (Exception $e) {
             return $e;
        }
    }

    public function CrearArchivo(){
        try {
            //obtener Razon de Empresa
                $Empresa = Regemp::where('id','=',request('id_empresa'))->get();

            $target_path = public_path().'/documentos/'.request('año').'/'.request('mes').'/' .$Empresa[0]['Razon'].'/'.request('ruta').'/';
            $target_path = $target_path . basename( $_FILES['archivo']['name']); 

            if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                return $this->principal('Archivo Cargado','OK',request('id_empresa'),request('año'),request('mes'),request('ruta'));
            } else{
                return $this->principal('Error al cargar el archivo','Error',request('id_empresa'),request('año'),request('mes'),request('ruta'));
            }

        }catch (Exception $e){
          return $e;
        }

        return $this->año;
    }

    public function Borrar(){
        try {

            //obtener Razon de Empresa
                $Empresa = Regemp::where('id','=',request('id_empresa'))->get();

            $target_path = public_path().'/documentos/'.request('año').'/'.request('mes').'/'.$Empresa[0]['Razon'].'/'.request('ruta').'/'; 
           
            //le disminuyes un nivel a ruta
                $ruta = request('ruta');
                $RutaExp = explode("/", $ruta);
                $newRuta='';
                for ($i=0; $i < count($RutaExp) - 1; $i++) {

                    $newRuta = $newRuta .'/'. $RutaExp[$i];

                }
            
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
                    return $this->principal('Error al eliminar la carpeta. Revise que la carpeta este vacía','Error',request('id_empresa'),request('año'),request('mes'),$newRuta);
                }else{
                    //eliminas carpeta
                    if (rmdir($target_path)) {
                        return $this->principal('Carpeta Eliminada','OK',request('id_empresa'),request('año'),request('mes'),$newRuta);
                    }else{
                        return $this->principal('Error al eliminar la carpeta.','Error',request('id_empresa'),request('año'),request('mes'),$newRuta);
                    }
                }                          
            }

        }catch (Exception $e){
          return $e;
        }
    }

    public function BorrarArchivo(){

         //obtener Razon de Empresa
                $Empresa = Regemp::where('id','=',request('id_empresa'))->get();

        $file = public_path().'/documentos/'.request('año').'/'.request('mes').'/'.$Empresa[0]['Razon'].'/'.request('ruta'); 
        //le disminuyes un nivel a ruta
            $ruta = request('ruta');
            $RutaExp = explode("/", $ruta);
            $newRuta='';
            for ($i=0; $i < count($RutaExp) - 1; $i++) { 
            $newRuta = $newRuta . $RutaExp[$i];

            } 
        if ( unlink($file)) {
             return $this->principal('Archivo Eliminado','OK',request('id_empresa'),request('año'),request('mes'),$newRuta);
        }else{
               return $this->principal('Error al eliminar el archivo','Error',request('id_empresa'),request('año'),request('mes'),request('ruta'));
        }       
        return request();
        
    }

    public function DescArchivo(){
        $file = storage_path();
        //$enlace = $path_a_tu_doc."/".$id;
        header ("Content-Disposition: attachment; filename=".request('nombre')." ");
        header ("Content-Type: application/octet-stream");
        header ("Content-Length: ".filesize($file));
        readfile($enlace);
                
    }

    public function DescCarpeta(){
        
    }

    public function Volver(){
        $ruta = request("ruta");
       
        $RutaExp = explode("/", $ruta);
        $newRuta='';
        for ($i=0; $i < count($RutaExp) - 1; $i++) { 
            $newRuta = $newRuta . $RutaExp[$i];         
        }
        return $this->principal('','',request('id_empresa'),request('año'),request('mes'),$newRuta);
       
    }

   
}
