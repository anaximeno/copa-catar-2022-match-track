<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    use HasFactory;

    protected $table = 'jogadores';

    /** Retorna todos os contratos do jogador com os times. */
    function contratos()
    {
        return $this->hasMany(\App\Models\JogadorContratado::class, 'id_jogador');
    }
}
