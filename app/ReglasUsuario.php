<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Regemp;
use App\User;

class ReglasUsuario extends Model
{
    //
     protected $table = 'reglas_usuario';
     protected $guarded = [];

    /*public function Usuario(){
		return $this->belongsTo(Regemp::class,'id_empresa');
	}*/

	public function Usuario(){
		return $this->belongsTo(User::class,'id_usuario');
	}
}
