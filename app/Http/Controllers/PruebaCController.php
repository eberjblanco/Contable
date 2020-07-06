<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PruebaCController extends Controller{
	public function index(){
        $DatosMail = ['Nombres' => 'El nombre', 
                'Mensaje' => 'Este es un mensaje', 
                'Archivos' => $_FILES['doc']['name']
        ]; 
        return view('PlantillasEmails/EnvioFactura')->with('DatosMail',$DatosMail);
        
	}     
}
