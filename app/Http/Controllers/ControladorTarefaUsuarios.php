<?php

namespace App\Http\Controllers;

use App\TarefaUsuarios;
use Illuminate\Http\Request;

class ControladorTarefaUsuarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
        $tarefaUsuarios = new TarefaUsuarios();
        $tarefaUsuarios->tarefa_id = $request->input('tarefa_id');
        $tarefaUsuarios->usuario_id = $request->input('usuario_id');
        $tarefaUsuarios->tempo_gasto = "00:00:00";
        $tarefaUsuarios->ultimo_start = "1900-01-01 00:00:00";
        $tarefaUsuarios->save();
        return json_encode($tarefaUsuarios);
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
        return TarefaUsuarios::where('tarefa_id', $id)->get()->toJson();
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
        $tarefaUsu = TarefaUsuarios::find($id);
        if(isset($tarefaUsu)){
            $tarefaUsu->delete();
            return response('OK', 200);
        }
        return response('Tarefa-Usuario nao encontrado', 404);
    }
}
