<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PerfilesController;

use App\Http\Controllers\BancoController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\TipoCuentaController;
use App\Http\Controllers\TarjetaCuentaController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\PagoServicioController;

// --------------------- Public routes --------------------------------- //
Route::get('/', function () {
    return view('welcome');
});
/* user routes */
Route::get('/signin', [UsuariosController::class, 'signin']);
Route::post('/login', [UsuariosController::class, 'login']);
Route::get('/logout/{type}', [UsuariosController::class, 'logout']);

Route::get('/respuesta', function () {
    return view('respuesta');
});
Route::get('/home', [UsuariosController::class, 'client']);

// ----------------- cliente routes ----------------------------------------- //
Route::get('/perfil', [PerfilesController::class, 'show']);
Route::post('/perfil/guardar', [PerfilesController::class, 'guardar']);
Route::get('/cuentas', [CuentasController::class, 'ver']);
Route::get('/cuentas/crear', [CuentasController::class, 'crear']);
Route::post('/cuentas/guardar', [CuentasController::class, 'guardar']);
Route::get('/cuentas/eliminar/{id}', [CuentasController::class, 'delete']);
Route::get('/transferencias', [TransaccionesController::class, 'index']);
Route::get('/transferencias/crear', [TransaccionesController::class, 'create']);
Route::post('/transferencias/guardar', [TransaccionesController::class, 'store']);
Route::get('/servicios', [PagoServicioController::class, 'index']);
Route::get('/servicios/crear/{id}', [PagoServicioController::class, 'create']);
Route::post('/servicios/guardar', [PagoServicioController::class, 'store']);

// ----------------- admin routes ----------------------------------------- //
Route::get('/admin', function () {
    return view('home-admin');
});
/* roles routes */
Route::get('/admin/roles', [RolesController::class, 'index']);
Route::get('/admin/roles/crear', [RolesController::class, 'create']);
Route::post('/admin/roles/crear', [RolesController::class, 'store']);
Route::get('/admin/roles/editar/{id}', [RolesController::class, 'edit']);
Route::put('/admin/roles/editar/{id}', [RolesController::class, 'update']);
Route::get('/admin/roles/eliminar/{id}', [RolesController::class, 'destroy']);
/* user admin routes */
Route::get('/admin/usuarios', [UsuariosController::class, 'index']);
Route::get('/admin/usuarios/crear', [UsuariosController::class, 'create']);
Route::post('/admin/usuarios/crear', [UsuariosController::class, 'store']);
Route::get('/admin/usuarios/editar/{id}', [UsuariosController::class, 'edit']);
Route::put('/admin/usuarios/editar/{id}', [UsuariosController::class, 'update']);
Route::get('/admin/usuarios/eliminar/{id}', [UsuariosController::class, 'destroy']);
/* banks admin routes */
Route::get('/admin/bancos', [BancoController::class, 'index']);
Route::get('/admin/bancos/crear', [BancoController::class, 'create']);
Route::post('/admin/bancos/crear', [BancoController::class, 'store']);
Route::get('/admin/bancos/editar/{id}', [BancoController::class, 'edit']);
Route::put('/admin/bancos/editar/{id}', [BancoController::class, 'update']);
Route::get('/admin/bancos/eliminar/{id}', [BancoController::class, 'destroy']);
/* account types admin routes */
Route::get('/admin/tipo-cuenta', [TipoCuentaController::class, 'index']);
Route::get('/admin/tipo-cuenta/crear', [TipoCuentaController::class, 'create']);
Route::post('/admin/tipo-cuenta/crear', [TipoCuentaController::class, 'store']);
Route::get('/admin/tipo-cuenta/editar/{id}', [TipoCuentaController::class, 'edit']);
Route::put('/admin/tipo-cuenta/editar/{id}', [TipoCuentaController::class, 'update']);
Route::get('/admin/tipo-cuenta/eliminar/{id}', [TipoCuentaController::class, 'destroy']);
/* accounts admin routes */
Route::get('/admin/cuentas', [CuentasController::class, 'index']);
Route::get('/admin/cuentas/crear', [CuentasController::class, 'create']);
Route::post('/admin/cuentas/crear', [CuentasController::class, 'store']);
Route::get('/admin/cuentas/editar/{id}', [CuentasController::class, 'edit']);
Route::put('/admin/cuentas/editar/{id}', [CuentasController::class, 'update']);
Route::get('/admin/cuentas/eliminar/{id}', [CuentasController::class, 'destroy']);
/* cards admin routes */
/* Route::get('/admin/tarjeta', [TarjetaCuentaController::class, 'index']);
Route::get('/admin/tarjeta/crear', [TarjetaCuentaController::class, 'create']);
Route::post('/admin/tarjeta/crear', [TarjetaCuentaController::class, 'store']);
Route::get('/admin/tarjeta/editar/{id}', [TarjetaCuentaController::class, 'edit']);
Route::put('/admin/tarjeta/editar/{id}', [TarjetaCuentaController::class, 'update']);
Route::get('/admin/tarjeta/eliminar/{id}', [TarjetaCuentaController::class, 'destroy']); */

