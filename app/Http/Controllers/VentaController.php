<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Venta;
use PDF;

class VentaController extends Controller
{
    public function index(){

        $ventas = DB::table('ventas')
        ->select('ventas.id_venta', 'clientes.nombre as nombreCliente', 'clientes.apellidos as apellidoCliente',
        'productos.precio', 'ventas.created_at', 'ventas.lugar_entrega',
        'productos.nombre as producto', 'productos.descuento', 'productos.id_producto','ventas.cantidad')
        ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
        ->join('productos', 'ventas.id_producto', '=', 'productos.id_producto')
        ->get();

        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos')->get();

        return view('ventas.ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function buscarVenta(Request $request){

        $ventas = DB::table('ventas')
        ->select('ventas.id_venta', 'clientes.nombre as nombreCliente', 'clientes.apellidos as apellidoCliente',
        'productos.precio', 'ventas.created_at', 'ventas.lugar_entrega',
        'productos.nombre as producto', 'productos.descuento', 'ventas.cantidad', 'productos.id_producto')
        ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
        ->join('productos', 'ventas.id_producto', '=', 'productos.id_producto')
        ->where(['ventas.id_venta'=>$request->buscar])
        ->orWhere('clientes.nombre', 'like', '%'.$request->buscar.'%')
        ->get();

        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos')->get();
        return view('ventas.ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function guardarVenta(Request $request){

        $venta = new Venta();
        $venta->id_venta = $this->ultimoID();
        $venta->id_cliente = $request->cliente;
        $venta->id_producto = $request->producto;
        $venta->created_at = $request->fechaFactura;
        $venta->fecha_entrega = $request->fechaEntrega;
        $venta->lugar_entrega = $request->lugarEntrega;
        $venta->cantidad = $request->cantidad;

        $precio = (double)DB::table('productos')->select('precio')
        ->where(['id_producto'=>$request->producto])
        ->get()[0]->precio;

        $venta->total = $request->cantidad * $precio;
        $venta->save();

        return redirect()->route('ventas');
    }

    public function agregarProductoVenta(Request $request){

        $venta = new Venta();
        $venta->id_venta = $request->idVenta;
        $venta->id_cliente = $request->cliente;
        $venta->id_producto = $request->producto;
        $venta->created_at = $request->fechaFactura;
        $venta->fecha_entrega = $request->fechaEntrega;
        $venta->lugar_entrega = $request->lugarEntrega;
        $venta->cantidad = $request->cantidad;

        $precio = (double)DB::table('productos')->select('precio')
        ->where(['id_producto'=>$request->producto])
        ->get()[0]->precio;

        $venta->total = $request->cantidad * $precio;
        $venta->save();

        return redirect()->route('ventas');
    }

    public function ultimoID(){
        $ventas = Venta::all();
        return count($ventas)+1;
    }

    public function editarVenta(Request $request){

        $venta = DB::table('ventas')
        ->select('ventas.id_venta', 'clientes.nombre as nombreCliente', 'clientes.apellidos as apellidoCliente',
        'productos.precio', 'ventas.created_at', 'ventas.lugar_entrega',
        'productos.nombre as producto', 'productos.descuento', 'ventas.cantidad', 'ventas.fecha_entrega')
        ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
        ->join('productos', 'ventas.id_producto', '=', 'productos.id_producto')
        ->where(["ventas.id_venta"=>$request->id_venta, "productos.id_producto"=>$request->id_producto])
        ->get();

        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos')->get();

        return view('ventas.editar', compact('venta', 'clientes', 'productos'));
    }

    public function actualizarVenta(Request $request){
        // dd($request);
        $sta = DB::table('ventas')->where(['id_venta'=>$request->id_venta, 'id_producto'=>$request->productoAnterior])->delete();

        $precio = (double)DB::table('productos')->select('precio')
        ->where(['id_producto'=>$request->producto])
        ->get()[0]->precio;

        $total = $request->cantidad * $precio;

        $state = DB::table('ventas')
        ->insert([
            "id_venta"=>$request->id_venta,
            'id_producto'=>(int)$request->producto,
            'id_cliente'=>(int)$request->cliente,
            'cantidad'=>(int)$request->cantidad,
            'fecha_entrega'=>$request->fechaEntrega,
            'lugar_entrega'=>$request->lugarEntrega,
            'created_at'=>$request->fechaCreacion,
            'total'=>$total
            ]);
            //dd($sta, $state, $request);
        return redirect()->route('ventas');
    }

    public function borrarVenta(Request $request){
        DB::table('ventas')->where(['id_venta'=>$request->id_venta, 'id_producto'=>$request->producto])->delete();
        //Borar Venta
        return redirect()->route('ventas');
    }

    public function eliminarVenta(Request $request){
        // dd($request->id_venta);
        $venta = DB::table('ventas')
        ->select('ventas.id_venta', 'clientes.nombre as nombreCliente', 'clientes.apellidos as apellidoCliente',
        'productos.precio', 'ventas.created_at', 'ventas.lugar_entrega',
        'productos.nombre as producto', 'productos.descuento', 'ventas.cantidad', 'ventas.fecha_entrega')
        ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
        ->join('productos', 'ventas.id_producto', '=', 'productos.id_producto')
        ->where(["ventas.id_venta"=>$request->id_venta, "productos.id_producto"=>$request->id_producto])
        ->get();
        // dd($venta);
        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos')->get();
        return view('ventas.delete', compact('venta', 'clientes', 'productos'));
    }

    public function facturacion(Request $request){
        $show = DB::table('ventas')
        ->select('ventas.id_venta', 'clientes.nombre as nombreCliente', 'clientes.apellidos as apellidoCliente',
        'productos.precio', 'ventas.created_at', 'ventas.lugar_entrega', 'productos.id_producto',
        'productos.nombre as producto', 'productos.descuento', 'ventas.cantidad', 'ventas.fecha_entrega',
         'ventas.total')
        ->join('clientes', 'ventas.id_cliente', '=', 'clientes.id_cliente')
        ->join('productos', 'ventas.id_producto', '=', 'productos.id_producto')
        ->where(["ventas.id_venta"=>$request->id_venta])
        ->get();
		//dd($show);
		$pdf = PDF::loadView('PDF.factura', compact('show'));
		return $pdf->stream('factura.pdf');
	}
}
