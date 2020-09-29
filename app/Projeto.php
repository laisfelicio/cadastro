<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    //
    protected $appends = ['cliente', 'status'];

    public function getClienteAttribute(): string
     {
        $cliente = Cliente::find($this->cliente_id);

        if ($cliente) {
            return $cliente->nome;
        }
        return '';
     }

     public function getStatusAttribute(): string
     {
        $status = StatusProjetos::find($this->status_id);

        if ($status) {
            return $status->nome;
        }
        return '';
     }
}
