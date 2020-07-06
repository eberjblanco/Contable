<?php

use Illuminate\Database\Seeder;
use App\Reglas;

class ReglasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       
        Reglas::create([
            'descripcion' => 'Visualizar Módulo de Documentos',
            
        ]); 
        Reglas::create([
            'descripcion' => 'Eliminar Documentos',
            
        ]);
        Reglas::create([
            'descripcion' => 'Agregar Usuarios a Empresas',
            
        ]); 
        Reglas::create([
            'descripcion' => 'Editar Usuarios de Empresas',
            
        ]);
        Reglas::create([
            'descripcion' => 'Gestionar Centros de Costo',
            
        ]);
        Reglas::create([
            'descripcion' => 'Cargar Factura',
            
        ]);
        Reglas::create([
            'descripcion' => 'Gestionar Seguridad',
            
        ]);        
    }
}
