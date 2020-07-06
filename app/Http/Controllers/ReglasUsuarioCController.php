<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Reglas;
use App\UserEmp;
use App\Regemp;
use App\ReglasUsuario;
use App\Http\Controllers\ReglasUsuarioCController;
$id_empresa_edit ='';
$id_usuario_edit ='';
$tipo_edit='';
$mensaje_edit='';



class ReglasUsuarioCController extends Controller
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

        $ReglasUsuario = new ReglasUsuarioCController;
        $Seguridad = $ReglasUsuario->show(Auth::id(),request('id_empresa'));


        $Empresa=Regemp::where('id','=',$id_empresa)->get();
        $Usuario = User::where('id','=',Auth::id());
        $Nivel=$Usuario->get('SuperAdmin')[0]['SuperAdmin'];
        $Reglas = Reglas::get();        
        if ($Nivel==0) {
            $Nivel = UserEmp::where('id_usuario','=',Auth::id())
                            ->where('id_empresa','=',$id_empresa)
                            ->get('id_nivel')[0]['id_nivel'];
            }

        $data = ['Tipo' => $tipo, 
            'Texto' => $mensaje,
            'Nivel' => $Nivel,
            'Empresa' => $Empresa,
            'Reglas'=> $Reglas,
            'Seguridad' => $Seguridad
           
        ];   
        return view('Reglas')->with('data',$data);
       
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
    public function store()
    {

        $Usuario = User::where('email','=',request('email'))->get();        
        if (count($Usuario)==0) {
            $men = 'El usuario '.request('email').' no esta registrado en el sistema';
            return $this->principal($men,'Error',request('id_empresa'));
        }

        $UsuarioEmpresa = UserEmp::where('id_usuario','=',$Usuario[0]['id'])
                                    ->where('id_empresa','=',request('id_empresa'))
                                    ->get();        
        if (count($UsuarioEmpresa)>0) {
            $men = 'El usuario '.request('email').' ya esta registrado en esta empresa';
            return $this->principal($men,'Error',request('id_empresa'));
        }


        //Tabla _User_Emp
        UserEmp::create([
            'id_usuario'=> $Usuario[0]['id'],           
            'id_empresa'=> request('id_empresa'),  
            'id_nivel'=> request('nivel'),  
            'id_status'=> request('habilitado')
        ]);




       

        for ($i=0; $i < 10000; $i++) { 
            if (isset($_POST['checkbox_'.$i])) {
                ReglasUsuario::create([
                    'id_usuario'=> $Usuario[0]['id'],
                    'id_regla'=> request('checkbox_'.$i),
                    'id_empresa'=> request('id_empresa'),                   
                ]);
            }
        }

        $men = 'El usuario '.request('email').' se ha Registrado en la empresa';
        return $this->principal($men,'OK',request('id_empresa'));

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReglasUsuario  $reglasUsuario
     * @return \Illuminate\Http\Response
     */
    public function show($id_usuario,$id_empresa)
    {
        //
        $Seguridad = ReglasUsuario::where('id_usuario','=',$id_usuario)
                            ->where('id_empresa','=',$id_empresa)
                            ->get();
        return $Seguridad;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReglasUsuario  $reglasUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //



       
        $empresa_prueba = request('id_empresa');
        if (isset($empresa_prueba)) {
            $id_empresa = request('id_empresa');
            $id_usuario = request('id_usuario');
            $tipo='';
            $mensaje='';
        }else{
            $id_empresa = $id_empresa_edit;
            $id_usuario = $id_usuario_edit;
            $tipo=$tipo_edit;          
            $mensaje=$mensaje_edit;
        }        
       
        
        //Seguridad
        $ReglasUsuario = new ReglasUsuarioCController;
        $Seguridad = $ReglasUsuario->show(Auth::id(),$id_empresa);



        $Empresa=Regemp::where('id','=',$id_empresa)->get();
        $Usuario = User::where('id','=',Auth::id());
        $Nivel=$Usuario->get('SuperAdmin')[0]['SuperAdmin'];
        $Reglas = Reglas::get();    

        if ($Nivel==0) {
            $Nivel = UserEmp::where('id_usuario','=',Auth::id())
                            ->where('id_empresa','=',$id_empresa)
                            ->get('id_nivel')[0]['id_nivel'];
        }

        //variable propias
        $UsuarioSel = User::where('id','=',$id_usuario)->get();
        $UsuarioSelUserEmp = UserEmp::where('id_usuario','=',$id_usuario)
                            ->where('id_empresa','=',$id_empresa)
                            ->get();



       
        $ReglasUsuario2 = $ReglasUsuario->show($id_usuario,$id_empresa);

        $data = ['Tipo' => $tipo, 
            'UsuarioSel' => $UsuarioSel,
            'UsuarioSelUserEmp' => $UsuarioSelUserEmp,
            'Texto' => $mensaje,
            'Nivel' => $Nivel,
            'Empresa' => $Empresa,
            'Reglas'=> $Reglas,
            'Seguridad' => $Seguridad,
            'ReglasUsuario2' => $ReglasUsuario2
           
        ];   
        return view('ReglasUsuarioEdit')->with('data',$data);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReglasUsuario  $reglasUsuario
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //

         //limitado o admin
            $UsuarioNivel = UserEmp::where('id_usuario','=', request('id_usuario'))
                    ->where('id_empresa','=',request('id_empresa'))
                    ->get();
            $empresa = UserEmp::find($UsuarioNivel[0]['id']);
            $empresa->id_nivel = request('nivel');
            $empresa->id_status = request('habilitado');
            $empresa->save();


             $ReglasUp = Reglas::get();
           

        for ($i=1; $i <= count($ReglasUp); $i++) {
         
            $UsuarioSelUserEmp = ReglasUsuario::where('id_usuario','=',request('id_usuario'))
                            ->where('id_empresa','=',request('id_empresa'))
                            ->where('id_regla','=',$i)
                            ->get();

               
                if (is_null(request('checkbox_'.$i))) {    
                     if (count($UsuarioSelUserEmp)>0) {
                        $elimRegla = ReglasUsuario::find($UsuarioSelUserEmp[0]['id']);           
                        $elimRegla->delete();
                    }
                   
                }else{
                    if (count($UsuarioSelUserEmp)==0) {
                          ReglasUsuario::create([
                        'id_usuario'=> request('id_usuario'),
                        'id_regla'=> request('id_regla_'.$i),
                        'id_empresa'=> request('id_empresa'),                   
                    ]); 
                    
                    }
                 
                   
                }
                   
        }

        $id_empresa_edit = request('id_empresa');
        $id_usuario_edit = request('id_usuario');
        $tipo_edit ='OK';
        $mensaje_edit='El usuario ha sido modificado exitosamente';
        return $this->edit();
        
          
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReglasUsuario  $reglasUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReglasUsuario $reglasUsuario)
    {
        //
           




       
    }
}
