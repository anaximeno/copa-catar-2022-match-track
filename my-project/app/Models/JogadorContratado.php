<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogadorContratado extends Model
{
    use HasFactory;

    protected $table = 'jogadores_contratados';

    /** O jogador que foi contratado. */
    function jogador()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador');
    }

    /** A equipa que contratou o jogador. */
    function equipe()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id', 'id_equipa');
    }
}
