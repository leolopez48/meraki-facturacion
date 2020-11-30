<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });

    //Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::post('/buscarCliente', [ClienteController::class, 'buscarCliente'])->name('buscarCliente');
    Route::get('/borrarCliente/{id_cliente}', [ClienteController::class, 'borrarCliente'])->name('borrarCliente');
    Route::get('/eliminarCliente/{id_cliente}', [ClienteController::class, 'eliminarCliente'])->name('eliminarCliente');
    Route::post('/guardarCliente', [ClienteController::class, 'guardarCliente'])->name('guardarCliente');
    Route::get('/editarCliente/{id_cliente}', [ClienteController::class, 'editarCliente'])->name('editarCliente');
    Route::post('/actualizarCliente', [ClienteController::class, 'actualizarCliente'])->name('actualizarCliente');

    //Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
    Route::post('/buscarProducto', [ProductoController::class, 'buscarProducto'])->name('buscarProducto');
    Route::get('/borrarProducto/{id_producto}', [ProductoController::class, 'borrarProducto'])->name('borrarProducto');
    Route::get('/eliminarProducto/{id_producto}', [ProductoController::class, 'eliminarProducto'])->name('eliminarProducto');
    Route::post('/guardarProducto', [ProductoController::class, 'guardarProducto'])->name('guardarProducto');
    Route::get('/editarProducto/{id_producto}', [ProductoController::class, 'editarProducto'])->name('editarProducto');
    Route::post('/actualizarProducto', [ProductoController::class, 'actualizarProducto'])->name('actualizarProducto');

    //Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');
    Route::post('/buscarVenta', [VentaController::class, 'buscarVenta'])->name('buscarVenta');
    Route::post('/borrarVenta', [VentaController::class, 'borrarVenta'])->name('borrarVenta');
    Route::get('/eliminarVenta/{id_venta}/{id_producto}', [VentaController::class, 'eliminarVenta'])->name('eliminarVenta');
    Route::post('/guardarVenta', [VentaController::class, 'guardarVenta'])->name('guardarVenta');
    Route::post('/agregarProducto', [VentaController::class, 'agregarProductoVenta'])->name('agregarProductoVenta');
    Route::get('/editarVenta/{id_venta}/{id_producto}', [VentaController::class, 'editarVenta'])->name('editarVenta');
    Route::post('/actualizarVenta', [VentaController::class, 'actualizarVenta'])->name('actualizarVenta');
    Route::get('/facturacion/{id_venta}', [VentaController::class, 'facturacion'])->name('facturacion');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
