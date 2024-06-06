<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\IntranetController;
use App\Http\Controllers\RRHHController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\privilegioController;
use App\Http\Controllers\CcController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\navbarController;
use App\Http\Controllers\inicioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Inicio (No es parte del programa)
Route::get('/',[InicioController::class, 'Inicio'])->name('Inicio');

//Navbar
Route::get('/Navbar',[navbarController::class, 'tienePrivilegio']);

//Usuario (Verificacion de usuarios)
Route::get('/Login', [UsuarioController::class, 'login'])->name('login')->middleware('guest');
Route::post('/iniciarSesion',[UsuarioController::class, 'iniciarSesion'])->name('iniciarSesion');
Route::post('/logout',[UsuarioController::class,'logout'])->name('logout');

//Intranet
Route::get('/Intranet', [IntranetController::class, 'Intranet'])->middleware('auth');

//Navbar Control
Route::get('/tienePrivilegio', [navbarController::class, 'tienePrivilegio'])->middleware('auth', 'verificar.privilegio:1');

/////RRHH/////

//Solicitud de compra
Route::get('/SolicitudCompra', [RRHHController::class, 'SolicitudCompra']) ->name('SolicitudCompra')->middleware('verificar.privilegio:1,2');
Route::get('/obtenerProductoInfo/{id}', [RRHHController::class, 'obtenerProductoInfo'])->name('obtenerProductoInfo')->middleware('verificar.privilegio:1,2');
Route::get('/obtenerProveedorInfo/{id}', [RRHHController::class, 'obtenerProveedorInfo'])->name('obtenerProveedorInfo')->middleware('verificar.privilegio:1,2');
Route::get('/productos-por-proveedor/{proveedor}',[RRHHController::class,'productosPorProveedor'])->name('productosPorProveedor')->middleware('verificar.privilegio:1,2');
Route::get('/obtener-detalles-producto/{id}', [RRHHController::class, 'obtenerDetallesProducto'])->name('obtenerDetallesProducto')->middleware('verificar.privilegio:1,2');
Route::get('/crear-ndoc', [RRHHController::class, 'crearNDoc'])->middleware('verificar.privilegio:1,2');
Route::get('/imprimirPDF',[RRHHController::class, 'imprimirPDF'])->name('imprimirPDF')->middleware('verificar.privilegio:1,2');

////Herramientas////

//Usuario

Route::get('/Usuarios', [UsuarioController::class,'Usuario'])->name("Usuarios")->middleware('verificar.privilegio:1,4,5');
Route::post('/crearusuario', [UsuarioController::class, 'crearUsuario'])->middleware('verificar.privilegio:1,4,5');
Route::get('/eliminarUsuario/{id}', [UsuarioController::class,'eliminarUsuario'])->name('eliminarUsuario')->middleware('verificar.privilegio:1,4,5');
Route::get('/examinarUsuario/{id}', [UsuarioController::class,'examinarUsuario'])->name('examinarUsuario')->middleware('verificar.privilegio:1,4,5');
Route::put('/actualizarUsuario/{id}', [UsuarioController::class,'actualizarUsuario'])->name('actualizarUsuario')->middleware('verificar.privilegio:1,4,5');

//Privilegio

Route::post('/agregarPrivilegio',[privilegioController::class, 'agregarPrivilegio'])->name('agregarPrivilegio')->middleware('verificar.privilegio:1,4,5');
Route::get('/eliminarPrivilegio/{id}',[privilegioController::class, 'eliminarPrivilegio'])->name('eliminarPrivilegio')->middleware('verificar.privilegio:1,4,5');


//Centro de costo

Route::get('/Cc', [CcController::class, 'Cc'])->name("Cc")->middleware('verificar.privilegio:1,4,6');
Route::post('crearCC', [CcController::class, 'crearCC'])->name("crearCC")->middleware('verificar.privilegio:1,4,6');
Route::get('/eliminarCc/{id}',[CcController::class,'eliminarCc'])->name("eliminarCc")->middleware('verificar.privilegio:1,4,6');
Route::get('/examinarCc/{id}',[CcController::class,'examinarCc'])->name('examinarCc')->middleware('verificar.privilegio:1,4,6');
Route::put('/modificarCC/{id}',[CcController::class,'modificarCC'])->name('modificarCC')->middleware('verificar.privilegio:1,4,6');

//Productos
Route::get('/Productos',[ProductosController::class,'Productos'])->name("Productos")->middleware('verificar.privilegio:1,4,7');
Route::post('/crearProducto',[ProductosController::class,'crearProducto'])->name("crearProducto")->middleware('verificar.privilegio:1,4,7');
Route::get('/examinarProducto/{id}',[ProductosController::class,'examinarProducto'])->name('examinarProducto')->middleware('verificar.privilegio:1,4,7');
Route::put('/actualizarProducto/{id}',[ProductosController::class,'actualizarProducto'])->name('actualizarProducto')->middleware('verificar.privilegio:1,4,7');
Route::get('/eliminarProducto/{id}',[ProductosController::class,'eliminarProducto'])->name('eliminarProducto')->middleware('verificar.privilegio:1,4,7');

//Proveedor
Route::get('/Proveedor',[ ProveedorController::class,'Proveedor'])->name('Proveedor')->middleware('verificar.privilegio:1,4,8');
Route::post('/crearProveedor',[ProveedorController::class,'crearProveedor'])->name('crearProveedor')->middleware('verificar.privilegio:1,4,8');
Route::get('/examinarProveedor/{id}',[ProveedorController::class,'examinarProveedor'])->name('examinarProveedor')->middleware('verificar.privilegio:1,4,8');
Route::put('/actualizarProveedor/{id}',[ProveedorController::class,'actualizarProveedor'])->name('actualizarProveedor')->middleware('verificar.privilegio:1,4,8');
Route::get('/eliminarProveedor/{id}',[ProveedorController::class,'eliminarProveedor'])->name('eliminarProveedor')->middleware('verificar.privilegio:1,4,8');
