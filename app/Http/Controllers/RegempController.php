<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regemp;
use App\Cc;
use App\Http\Controllers\DocumentosCController;

class RegempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
             $men = '';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
              
                'Tipo' => '', 
                'Texto' => $men
            ];
        return view('regemp')->with('data',$data);
            
        } catch (Exception $e) {

            return $e;
            
        }

        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ///
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

             $Nit = Regemp::where('Razon','=',request('Razon_nva'))
                        ->orWhere('Nit','=',request('Nit_nva'))
                        ->get();


        if (count($Nit) > 0) {
            $men = 'El Nit o la Razón ya existe en el sistema';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
                'Tipo' => 'Error', 
                'Texto' => $men
            ];
            return view('regemp')->with('data',$data);

        }else{


            $id_empresa = Regemp::create([                
                'Nit'=> request('Nit_nva').'-'.request('Nit_nva_dig'),
                'Razon'=> request('Razon_nva'),
                'Departamento'=> request('Departamento_nva'),
                'Municipio'=> request('Municipio_nva'),
                'Direccion'=> request('Direccion_nva'),
                'Correo'=> request('Correo_nva'),
                'Telefono'=> request('Telefono_nva'),

            ]);

            // creas centro de costo principal
            Cc::create([
                'id_empresa'=> $id_empresa['id'],
                'codigo'=> '1-0',
                'descripcion'=> '1-0',
                'habilitado'=> 1,
                'año'=> date('Y'),
                'mes'=> date('n'),
            ]);

            //creas arbol por primera Vez
            $micarpeta = public_path().'/documentos/'.date('Y').'/'.date('n').'/'. request('Razon_nva').'/Principal';
            if (!file_exists($micarpeta)) {  
                
                for ($i=1; $i < 13; $i++) { 
                    mkdir(public_path().'/documentos/Temp/'.request('Razon_nva').'/'.$i, 0777, true);
                }
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

            //subir archivo del logo
                $target_path = public_path().'/logos/'.$id_empresa['id'].'.jpeg';                
                move_uploaded_file($_FILES['imgInp']['tmp_name'], $target_path);


            $men = 'La Empresa se ha Registrado';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
                'Tipo' => 'OK', 
                'Texto' => $men
            ];
            return view('regemp')->with('data',$data);
        }
            
        } catch (Exception $e) {

            return $e;
            
        }
        // validar que no este en la base de datos
       


       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return "string";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


       
        //$Nit = Regemp::where('Razon','=',request('Razon_edit'))
                        //->orWhere('Nit','=',request('Nit_edit'))
                        //->get();
        $Nit=0;

        if ($Nit > 0) {
            $men = 'El Nit o la Razón ya existe en el sistema';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
                'Tipo' => 'Error', 
                'Texto' => $men
            ];
            return view('regemp')->with('data',$data);

        }else{


            $empresa = Regemp::find(request('id'));
            //$empresa->Nit = request('Nit_edit');
            //$empresa->Razon = request('Razon_edit');
            $empresa->Departamento = request('Departamento_nva_edit');
            $empresa->Municipio = request('Municipio_nva_edit');
            $empresa->Direccion = request('Direccion_edit');
            $empresa->Correo = request('Correo_edit');
            $empresa->Telefono = request('Telefono_edit');
            $empresa->save();





            $men = 'La Empresa se ha Actualizado';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
                'Tipo' => 'OK', 
                'Texto' => $men
            ];
            return view('regemp')->with('data',$data);
        }

       

       
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        //

            $empresa = Regemp::find(request('id_elim'));
           
            $empresa->delete();





            $men = 'La Empresa se ha Eliminado';
            $Empresas = Regemp::get();       
            $data = ['Empresas' => $Empresas, 
                'Tipo' => 'OK', 
                'Texto' => $men
            ];
            return view('regemp')->with('data',$data);



       
    }

    
}
