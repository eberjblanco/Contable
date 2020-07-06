<?php

use Illuminate\Database\Seeder;
use App\Estados;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estados::create([
            
            'descripcion' => 'Entregado por Cliente',
            'Habilitado' => 1,            
        ]); 
        Estados::create([
            
            'descripcion' => 'Contabilización',
            'Habilitado' => 1,            
        ]);
        Estados::create([
            
            'descripcion' => 'Revisión',
            'Habilitado' => 1,            
        ]);
        Estados::create([
            
            'descripcion' => 'Aprobado',
            'Habilitado' => 1,            
        ]);
        Estados::create([
            
            'descripcion' => 'Archivado',
            'Habilitado' => 1,            
        ]); 
    }
}
