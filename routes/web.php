<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuariosController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios/index', [UsuariosController::class, 'index']);

Route::post('/usuarios/login', [UsuariosController::class, 'login']);

Route::get('/usuarios/crear', [UsuariosController::class, 'create']);

Route::post('/usuarios/crear', [UsuariosController::class, 'store']);

Route::get('/usuarios/logout', [UsuariosController::class, 'logout']);

Route::get('/respuesta', function () {
    return view('respuesta');
});
Route::get('/home', function () {
    return view('home-client');
});

Route::get('/admin', function () {
    return view('home-admin');
});

// admin routes
Route::get('/admin/roles', function () {
    return view('roles\roles-list');
});
