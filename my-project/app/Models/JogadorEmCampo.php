<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogadorEmCampo extends Model
{
    use HasFactory;

    protected $table = 'jogador_em_campo';

    /** Retorna o confronto em que o jogador está participando */
    function confronto()
    {
        return $this->hasOne(\App\Models\Confronto::class, 'id', 'id_confronto');
    }

    /** Retorna o jogador em campo. */
    function jogador()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador');
    }

    /** Retorna a equipa do jogador */
    function equipa()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id', 'id_equipa');
    }
}
