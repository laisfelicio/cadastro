<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

/*Auth::routes();*/
Route::get('/projetos', 'ControladorProjeto@index');
Route::get('/categorias', 'ControladorCategoria@index');
Route::get('/categorias/novo', 'ControladorCategoria@create');
Route::post('/categorias', 'ControladorCategoria@store');
Route::get('/categorias/apagar/{id}', 'ControladorCategoria@destroy');
Route::get('/categorias/editar/{id}', 'ControladorCategoria@edit');
Route::post('/categorias/{id}', 'ControladorCategoria@update');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homepage', function () {
    return view('homepage');
});
Route::get('/novoProjeto', function () {
    return view('novoProjeto');
});

Route::get('/novaTarefa', function () {
    return view('novaTarefa');
});

Route::get('/clientes', 'ControladorCliente@indexView');
Route::get('/projetos', 'ControladorProjeto@indexView');
Route::get('/usuarios', 'ControladorUsuario@indexView');
Route::get('/tarefas', 'ControladorTarefa@indexView');
