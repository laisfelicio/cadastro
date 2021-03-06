<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/clientes', 'ControladorCliente');
Route::resource('/projetos', 'ControladorProjeto');
Route::resource('/usuarios', 'ControladorUsuario');
Route::resource('/times', 'ControladorTime');
Route::resource('/usuarioprojeto', 'ControladorUsuarioProjeto');
Route::resource('/tarefas', 'ControladorTarefa');
Route::resource('/statustarefas', 'ControladorStatusTarefa');
Route::resource('/tarefausuarios', 'ControladorTarefaUsuarios');