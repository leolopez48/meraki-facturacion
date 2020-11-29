<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;
use App\Models\Telefono;

class ClienteController extends Controller
{
    public function index(){
        $clientes = DB::table('clientes')
        ->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();

        return view('clientes.clientes', compact('clientes'));
    }

    public function buscarCliente(Request $request){
        $clientes = DB::table('clientes')
        ->where('clientes.nombre', 'like', '%'.$request->buscar.'%')
        ->orWhere(['clientes.id_cliente'=>$request->buscar])
        ->orWhere('clientes.nombre', 'like', '%'.$request->buscar.'%')
        ->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();
        return view('clientes.clientes', compact('clientes'));
    }

    public function guardarCliente(Request $request){

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->save();

        $tel = new Telefono();
        $tel->telefono = $request->telefono;
        // De esta forma se obtiene el ultimo id ingresado
        $tel->id_cliente = $cliente->id;
        $tel->save();

        return redirect()->route('clientes');
    }

    public function editarCliente(Request $request){
        $cliente = DB::table('clientes')
        ->where(["clientes.id_cliente"=>(int)$request->id_cliente])
        ->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();
        return view('clientes.editar', compact('cliente'));
    }

    public function actualizarCliente(Request $request){
        DB::table('telefonos')
        ->where(["id_cliente"=>$request->id_cliente])
        ->update(['telefono'=>$request->telefono]);
        DB::table('clientes')
        ->where(["id_cliente"=>$request->id_cliente])
        ->update(['nombre'=>$request->nombre, 'apellidos'=>$request->apellidos]);
        return redirect()->route('clientes');
    }

    public function borrarCliente(Request $request){
        DB::table('telefonos')->where(['id_cliente'=>$request->id_cliente])->delete();
        DB::table('clientes')->where(['id_cliente'=>$request->id_cliente])->delete();
        //Borar Venta
        return redirect()->route('clientes');
    }

    public function eliminarCliente(Request $request){
        $cliente = DB::table('clientes')
        ->where(["clientes.id_cliente"=>(int)$request->id_cliente])
        ->join('telefonos', 'clientes.id_cliente', '=', 'telefonos.id_cliente')
        ->get();
        return view('clientes.delete', compact('cliente'));
    }

}
