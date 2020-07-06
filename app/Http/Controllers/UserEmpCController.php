<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserEmp;
use App\User;
use App\Regemp;

class UserEmpCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $men = '';          
        $Usuarios = User::get();   
        $UsuEmp = UserEmp::where('id_empresa','=',request('id'))->get();
        $Emp = Regemp::where('id','=',request('id'))->get();

        $data = ['UsuEmp' => $UsuEmp,  
        'Emp' => $Emp,          
        'Usuarios' => $Usuarios,
        'Tipo' => '', 
        'Texto' => $men
        ];            
        return view('UserEmp')->with('data',$data);
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
        $UsuEmpVer = UserEmp::where('id_empresa','=',request('id_empresa'))
                            ->where('id_usuario','=',request('id_usuario'))
                            ->get();

        if (count($UsuEmpVer) > 0) {
            $men = 'El usuario ya esta asignado a esta empresa';
            $Usuarios = User::get();   
            $UsuEmp = UserEmp::where('id_empresa','=',request('id_empresa'))->get();
            $Emp = Regemp::where('id','=',request('id_empresa'))->get();

            $data = ['UsuEmp' => $UsuEmp,  
            'Emp' => $Emp,          
            'Usuarios' => $Usuarios,
            'Tipo' => 'Error', 
            'Texto' => $men
            ];            
            return view('UserEmp')->with('data',$data);

        }else{
            
           
            UserEmp::create([
                'id_empresa'=> request('id_empresa'),
                'id_usuario'=> request('id_usuario'),
                'id_nivel'=> 2,
                'id_status'=> 1,
            ]);
            
            $men = 'El Usuario se ha agregado a la Empresa';
            $Usuarios = User::get();   
            $UsuEmp = UserEmp::where('id_empresa','=',request('id_empresa'))->get();
            $Emp = Regemp::where('id','=',request('id_empresa'))->get();

            $data = ['UsuEmp' => $UsuEmp,  
                'Emp' => $Emp,          
                'Usuarios' => $Usuarios,
                'Tipo' => 'OK', 
                'Texto' => $men
            ];            
            return view('UserEmp')->with('data',$data);
          
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
        $Usuario = UserEmp::find(request('id'));
           
        $Usuario->delete();

        $men = 'El Usuario se ha Eliminado de la Empresa';
        $Usuarios = User::get();   
        $UsuEmp = UserEmp::where('id_empresa','=',request('id_empresa'))->get();
        $Emp = Regemp::where('id','=',request('id_empresa'))->get();

        $data = ['UsuEmp' => $UsuEmp,  
        'Emp' => $Emp,          
        'Usuarios' => $Usuarios,
        'Tipo' => 'OK', 
        'Texto' => $men
        ];            
        return view('UserEmp')->with('data',$data);
    }
}
