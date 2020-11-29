<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    public function guardarTelefono($tel){
        DB::insert(["telefono"=>$tel->telefono, "id_cliente"=>$tel->id_cliente]);
    }
}
