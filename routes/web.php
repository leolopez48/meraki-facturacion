<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;

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
    Route::post('/guardarCliente', [ClienteController::class, 'guardarCliente'])->name('guardarCliente');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
