<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
class ControladorProjeto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $projetos = Projeto::all();
        return $projetos->toJson();
    }

    public function indexView()
    {
        //
        return view('projetos');
       
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
        $proj = new Projeto();
        $proj->nome = $request->input('nome');
        $proj->descricao = $request->input('descricao');
        $proj->cliente_id = $request->input('cliente_id');
        $proj->status_id = $request->input('status_id');
        $proj->tempo_gasto = "00:00:00";
        $proj->save();
        return json_encode($proj);
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
        $projeto = Projeto::find($id);
        if(isset($projeto)){
            return json_encode($projeto);
        }
        return response('Projeto nao encontrado', 404);
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
        $projeto = Projeto::find($id);
        if(isset($projeto)){
            $projeto->nome = $request->input('nome');
            $projeto->descricao = $request->input('descricao');
            $projeto->cliente_id = $request->input('cliente_id');
            $projeto->status_id = $request->input('status_id');
            $projeto->tempo_gasto = "00:00:00";
            $projeto->save();
            return json_encode($projeto);
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
        $projeto = Projeto::find($id);
        if(isset($projeto)){
            $projeto->delete();
            return response('OK', 200);
        }
        return response('Projeto nao encontrado', 404);
    }
}
