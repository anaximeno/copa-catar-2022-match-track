<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gol extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jogador_em_campo',
        'tempo_do_jogo',
        'detalhes'
    ];

    /** O jogador que marcou o golo */
    function jogador()
    {
        return $this->hasOneThrough(
            \App\Models\Jogador::class,
            \App\Models\JogadorEmCampo::class,
            'id',
            'id',
            'id_jogador_em_campo',
            'id_jogador'
        );
    }

    /** A equipa que marcou o golo */
    function equipa()
    {
        return $this->jogador()->equipa;
    }

    /** O confronto decorrente no momento */
    function confronto()
    {
        return $this->hasOneThrough(
            \App\Models\Confronto::class,
            \App\Models\JogadorEmCampo::class,
            'id',
            'id',
            'id_jogador_em_campo',
            'id_confronto'
        );
    }
}
