<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipa extends Model
{
    use HasFactory;

    protected $table = 'equipes';

    protected $fillable = [
        'nome',
        'simbolo',
        'local_pertencente'
    ];

    /** Retorna os jogadores da equipa. */
    function jogadores()
    {
        return $this->hasMany(\App\Models\Jogador::class, 'id_equipa');
    }

    /** Retorna os confrontos em casa da equipa. */
    function confrontosEmCasa()
    {
        return $this->hasMany(\App\Models\Confronto::class, 'id_equipa_casa');
    }

    /** Retorna os confrontos em visita da equipa. */
    function confrontosEmVisita()
    {
        return $this->hasMany(\App\Models\Confronto::class, 'id_equipa_visita');
    }

    // Retorna todos os confrontos da equipa
    // function confrontos() // TODO
    // {
    // }

    /** Todas as substituições que ocorreram na equipa. */
    function substituicoes()
    {
        return $this->hasMany(\App\Models\Substituicao::class, 'id_equipa');
    }
}
