<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;

class ClienteController extends Controller
{
    public function index(){
        $clientes = DB::table('clientes')
        //->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();

        return view('clientes', compact('clientes'));
    }

    public function buscarCliente(Request $request){
        $clientes = DB::table('clientes')
        ->where(['clientes.nombre'=>$request->buscar])
        ->orWhere(['clientes.id_cliente'=>$request->buscar])
        ->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();
        return view('clientes', compact('clientes'));
    }
}
