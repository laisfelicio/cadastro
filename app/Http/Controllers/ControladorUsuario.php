<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
class ControladorUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = Usuario::all();
        return $usuarios->toJson();
    }

    public function indexView()
    {
        //
        return view('usuarios');
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usuario = new Usuario();
        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->senha = $request->input('senha');
        $usuario->time_id = $request->input('time_id');
        $usuario->save();
        return json_encode($usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $usuario = Usuario::find($id);
        if(isset($usuario)){
            return json_encode($usuario);
        }
        return response('Usuario nao encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $usuario = Usuario::find($id);
        if(isset($usuario)){
            $usuario->email = $request->input('email');
            $usuario->senha = $request->input('senha');
            $usuario->time_id = $request->input('time_id');
            $usuario->save();
            return json_encode($usuario);
        }
        return response('Projeto nao encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = Usuario::find($id);
        if(isset($usuario)){
            $usuario->delete();
            return response('OK', 200);
        }
        return response('Projeto nao encontrado', 404);
    }
}
