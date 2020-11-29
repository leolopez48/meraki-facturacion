<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB;

class ProductoController extends Controller
{
    public function index(){
        $productos = DB::table('productos')
        ->get();

        return view('productos.productos', compact('productos'));
    }

    public function buscarProducto(Request $request){
        $productos = DB::table('productos')
        ->where(['productos.id_producto'=>$request->buscar])
        ->orWhere('productos.nombre', 'like', '%'.$request->buscar.'%')
        ->get();
        return view('productos.productos', compact('productos'));
    }

    public function guardarProducto(Request $request){
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descuento = (double)$request->descuento;
        $producto->precio = (double)$request->precio;
        $producto->save();

        return redirect()->route('productos');
    }

    public function editarProducto(Request $request){
        $producto = DB::table('productos')
        ->where(["productos.id_producto"=>(int)$request->id_producto])
        ->get();
        return view('productos.editar', compact('producto'));
    }

    public function actualizarProducto(Request $request){
        DB::table('productos')
        ->where(["id_producto"=>$request->id_producto])
        ->update(['nombre'=>$request->nombre, 'precio'=>$request->precio, 'descuento'=>$request->descuento]);
        return redirect()->route('productos');
    }

    public function borrarProducto(Request $request){
        DB::table('productos')->where(['id_producto'=>$request->id_producto])->delete();
        //Borar Venta
        return redirect()->route('productos');
    }

    public function eliminarProducto(Request $request){
        $producto = DB::table('productos')
        ->where(["productos.id_producto"=>(int)$request->id_producto])
        ->get();
        return view('productos.delete', compact('producto'));
    }
}
