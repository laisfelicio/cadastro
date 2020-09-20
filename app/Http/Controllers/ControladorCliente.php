<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
class ControladorCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $clientes = Cliente::all();
        return $clientes->toJson();
    }

    public function indexView()
    {
        //
        return view('clientes');
       
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
        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->save();
        return json_encode($cliente);
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
        $cliente = Cliente::find($id);
        if(isset($cliente)){
            return json_encode($cliente);
        }
        return response('Cliente nao encontrado', 404);
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
        $cliente = Cliente::find($id);
        if(isset($cliente)){
            $cliente->nome = $request->input('nome');
            $cliente->save();
            return json_encode($cliente);
        }
        return response('Produto nao encontrado', 404);
       
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
        $cliente = Cliente::find($id);
        if(isset($cliente)){
            $cliente->delete();
            return response('OK', 200);
        }
        return response('Cliente nao encontrado', 404);

    }
}
