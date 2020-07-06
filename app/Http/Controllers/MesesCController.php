<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meses;

class MesesCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->principal('','');
    }

    public function principal($mensaje,$tipo){
        $Meses=Meses::get();
        $data = ['Tipo' => $tipo, 
            'Texto' => $mensaje,    
            'Meses' => $Meses
        ]; 
        return view('Meses')->with('data',$data);
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
        try {
            //validar si existe
             $Registro = Meses::where('año','=',request('año'))
                        ->Where('mes','=',request('mes'))
                        ->get();
            if (count($Registro)==1) {
                 return $this->principal('El período ya esta habilitado','Error');
            }

            //crea el registro
            Meses::create([
                'año'=> request('año'),           
                'mes'=> request('mes'), 
            ]);
            return $this->principal('El período ha sido habilitado','OK');
        } catch (Exception $e) {
            return $this->principal('Error al habilitar el período','Error');
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
        $Registro = Meses::find(request('id'));
        $Registro->delete();
        return $this->principal('El período ha sido Eliminado','OK');
    }
}
