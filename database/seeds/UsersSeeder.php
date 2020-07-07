<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Eber Blanco',
            'email' => 'eberj.blanco@gmail.com',          
            'password' => Hash::make('123'),
            'SuperAdmin' => '1'
        ]); 
        User::create([
            'name' => 'Fabian',
            'email' => 'Contador.ft@gmail.com',          
            'password' => Hash::make('123'),
            'SuperAdmin' => '1'
        ]); 
        User::create([
            'name' => 'Vanesa',
            'email' => 'vane.fcfabian@gmail.com',          
            'password' => Hash::make('123'),
            'SuperAdmin' => '1'
        ]); 
        User::create([
            'name' => 'Yoshua Soto',
            'email' => 'yoshuasoto12@outlook.com',          
            'password' => Hash::make('123'),
            'SuperAdmin' => '1'
        ]); 
    }
}
