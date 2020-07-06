<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Regemp;
use App\UserEmp;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->principal('','');
    }

    public function principal($mensaje,$tipo){
        $men = $mensaje;
        $Usuarios = User::get();  
        $Empresas = Regemp::orderBy('Razon', 'Asc')->get();       
        $data = ['Usuarios' => $Usuarios,
            'Empresas' => $Empresas, 
            'Tipo' => $tipo, 
            'Texto' => $men
        ];            
        return view('Usuarios')->with('data',$data);
       
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

        //verifica claves iguales
        if (request('clave1')!= request('clave2')) {
            $men = 'Las claves no coinciden';
            return $this->principal($men,'Error');
        }

        //Verifica si el registro existe
        $Registro = User::where('email','=',request('email'))->get();
        if (count($Registro) > 0) {
            $men = 'El nombre o el email ya existe en el sistema';
           return $this->principal($men,'Error');
        }


        //Si es un SuperAdmin
        if (request('id_empresa')=='') {
            User::create([
                'name'=> request('name'),
                'email'=> request('email'),
                'password'=> Hash::make(request('clave1')),
                'SuperAdmin' => 1
            ]);
            $men = 'El usuario se ha Registrado';
            return $this->principal($men,'OK');
        }else{

            $usuario = User::create([
                'name'=> request('name'),
                'email'=> request('email'),
                'password'=> Hash::make(request('clave1')),
                'SuperAdmin' => 0
            ]);

             //id de usuario

            UserEmp::create([
                'id_usuario'=> $usuario->id,
                'id_empresa'=> request('id_empresa'),
                'id_nivel'=> 2,
                'id_status' => 1
            ]);

            $men = 'El usuario se ha Registrado';
            return $this->principal($men,'OK');
        }
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
    public function update(Request $request)
    {
        //
        $Usuario = User::find(request('id'));
        $Usuario->name = request('name');
        $Usuario->save();
        $men = 'El usuario se ha Actualizado';
        return $this->principal($men,'OK');   
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
        $Usuario = User::find(request('id_elim'));           
        $Usuario->delete();
        $men = 'El usuario se ha Eliminado';
        return $this->principal($men,'OK');
    }
}
