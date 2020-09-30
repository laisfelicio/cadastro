<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    //
    protected $appends = ['projeto', 'status'];

    public function getProjetoAttribute(): string
     {
        $projeto = Projeto::find($this->projeto_id);

        if ($projeto) {
            return $projeto->nome;
        }
        return '';
     }

     public function getStatusAttribute(): string
     {
        $status = StatusTarefas::find($this->status_id);

        if ($status) {
            return $status->nome;
        }
        return '';
     }
}
