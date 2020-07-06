<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Estados;
use App\Cc;

class Est_tran extends Model
{
    protected $table = 'est_tran';
     protected $guarded = [];

    public function User(){
		return $this->belongsTo(User::class,'id_usuario');
	}

	public function Estado(){
		return $this->belongsTo(Estados::class,'id_estado');
	}

	public function Cc(){
		return $this->belongsTo(Cc::class,'id_cc');
	}
}
