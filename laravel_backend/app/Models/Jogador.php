<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    use HasFactory;

    protected $table = 'jogadores';

    protected $fillable = [
        'nome',
        'sobrenome',
        'apelido',
        'idade',
        'id_equipa',
        'posicao',
        'numero_camisa',
    ];

    /** Retorna a equipa do jogador. */
    function equipa()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id_equipa');
    }

    /** Retorna os jogos que o jogador jogou. */
    function jogosEmCampo()
    {
        return $this->hasMany(\App\Models\JogadorEmCampo::class, 'id_jogador');
    }

    function gols()
    {
        return $this->hasManyThrough(
            \App\Models\Gol::class,
            \App\Models\JogadorEmCampo::class,
            'id_jogador',
            'id_jogador_em_campo',
            'id',
            'id'
        );
    }

    function cartoes()
    {
        return $this->hasManyThrough(
            \App\Models\Cartao::class,
            \App\Models\JogadorEmCampo::class,
            'id_jogador',
            'id_jogador_em_campo',
            'id',
            'id'
        );
    }
}
