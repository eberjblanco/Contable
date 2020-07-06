<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        
        $this->call(ReglasSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
