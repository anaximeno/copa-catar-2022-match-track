<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogadorEmCampo extends Model
{
    use HasFactory;

    protected $table = 'jogador_em_campo';

    protected $fillable = [
        'id_jogador',
        'id_confronto',
        'tempo_de_entrada',
        'tempo_de_saida'
    ];

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
        return $this->hasOneThrough(
            \App\Models\Equipa::class,
            \App\Models\Jogador::class,
            'id_jogador',
            'id_equipa',
            'id',
            'id'
        );
    }

    /** Retorna os cartões que o jogadore recebeu em campo. */
    function cartoes()
    {
        return $this->hasMany(\App\Models\Cartao::class, 'id_jogador_em_campo');
    }

    /** Retorna todos os golos que o jogador marcou. */
    function gols()
    {
        return $this->hasMany(\App\Models\Gol::class, 'id_jogador_em_campo');
    }
}
