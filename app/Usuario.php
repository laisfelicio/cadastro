<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $appends = ['time'];



public function getTimeAttribute(): string
    {
        $time = Time::find($this->time_id);

        if ($time) {
            return $time->nome;
        }
        return '';
    }
}
