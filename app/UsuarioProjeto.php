<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioProjeto extends Model
{
    //
    protected $appends = ['usuarioNome', 'usuarioEmail'];

    public function getUsuarioNomeAttribute(): string
    {
        $usuario = Usuario::find($this->usuario_id);

        if ($usuario) {
            return $usuario->nome;
        }
        return '';
    }

    public function getUsuarioEmailAttribute(): string
    {
        $usuario = Usuario::find($this->usuario_id);

        if ($usuario) {
            return $usuario->email;
        }
        return '';
    }
}


