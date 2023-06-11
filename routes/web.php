<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RolesController;

// --------------------- Public routes --------------------------------- //
Route::get('/', function () {
    return view('welcome');
});
/* user routes */
Route::get('/signin', [UsuariosController::class, 'signin']);
Route::post('/login', [UsuariosController::class, 'login']);
Route::get('/logout', [UsuariosController::class, 'logout']);

Route::get('/respuesta', function () {
    return view('respuesta');
});
Route::get('/home', function () {
    return view('home-client');
});

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
