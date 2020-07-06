<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail; 

class Email extends Model
{
    public function contact($datos){
        $subject = $datos['asunto'];
        $for = $datos['dest'];

        Mail::send('email',$request->all(), function($msj) use($subject,$for){
            $msj->from("ContableWork@gmail.com","ContableWork");
            $msj->subject($subject);
            $msj->to($for);
        });        
    }
}
