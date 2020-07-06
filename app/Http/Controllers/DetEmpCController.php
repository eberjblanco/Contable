<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserEmp;
use App\Regemp;
use App\ReglasUsuario;
use App\Meses;
use App\Http\Controllers\ReglasUsuarioCController;
$id_empresa='';


class DetEmpCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->principal('','',request('id_empresa'));

    }

     public function principal($mensaje,$tipo,$id_empresa){

         //Evalua Seguridad
        $ReglasUsuario = new ReglasUsuarioCController;
        $Seguridad = $ReglasUsuario->show(Auth::id(),$id_empresa);


        $Usuario = User::where('id','=',Auth::id());

        $Nivel=$Usuario->get('SuperAdmin')[0]['SuperAdmin'];
        $Empresa=Regemp::where('id','=',$id_empresa)->get();
        $Trabajadores=UserEmp::where('id_empresa','=',$id_empresa)->get();
        $Meses=Meses::get();
        $año=Meses::distinct()->get('año');

        if ($Nivel==0) {
            $Nivel = UserEmp::where('id_usuario','=',Auth::id())
                            ->where('id_empresa','=',$id_empresa)
                            ->get('id_nivel')[0]['id_nivel'];
        }
        
        $men = $mensaje;   
        $data = ['id_empresa' => $id_empresa,   
            'Empresa' => $Empresa,         
            'Nivel'=> $Nivel,          
            'Tipo' => $tipo, 
            'Texto' => $men,
            'Seguridad' => $Seguridad,
            'Trabajadores' => $Trabajadores,
            'Meses' => $Meses,
            'año' => $año,
        ];  

        return view('DetalleEmpresa')->with('data',$data);

       

       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //

        
        UserEmp::where('id_usuario','=',request('id_usuario'))->delete();     
        ReglasUsuario::where('id_usuario','=',request('id_usuario'))->delete();          
       
       

        return $this->principal('El usuario ha sido eliminado de la empresa','OK',request('id_empresa'));

    }
}
