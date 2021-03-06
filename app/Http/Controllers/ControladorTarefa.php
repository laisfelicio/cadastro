<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarefa;
class ControladorTarefa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        //
        return view('tarefas');
    }

    public function index()
    {
        //
        $tarefas = Tarefa::all();
        return $tarefas->toJson();
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
        $tarefa = new Tarefa();
        $tarefa->projeto_id = $request->input('projeto_id');
        $tarefa->nome = $request->input('nome');
        $tarefa->descricao = $request->input('descricao');
        $tarefa->tempo_previsto = $request->input('tempo_previsto');
        $tarefa->status_id = $request->input('status_id');
        $tarefa->save();
        return json_encode($tarefa);
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
        $tarefa = Tarefa::find($id);
        if(isset($tarefa)){
            return json_encode($tarefa);
        }
        return response('Tarefa nao encontrado', 404);
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
        $tarefa = Tarefa::find($id);
        if(isset($tarefa)){
            $tarefa->projeto_id = $request->input('projeto_id');
            $tarefa->nome = $request->input('nome');
            $tarefa->descricao = $request->input('descricao');
            $tarefa->tempo_previsto = $request->input('tempo_previsto');
            $tarefa->status_id = $request->input('status_id');
            $tarefa->save();
            return json_encode($tarefa);
        }
        return response('Tarefa nao encontrado', 404);


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
        $tarefa = Tarefa::find($id);
        if(isset($tarefa)){
            $tarefa->delete();
            return response('OK', 200);
        }
        return response('Tarefa nao encontrado', 404);
    }
}
