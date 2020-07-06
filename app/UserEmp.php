<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Regemp;
use App\User;

class UserEmp extends Model
{
	protected $table = '_user_emp';
	protected $guarded = [];

	public function User(){
		return $this->belongsTo(User::class,'id_usuario');
	}

	public function Empresa(){
		return $this->belongsTo(Regemp::class,'id_empresa');
	}
}
