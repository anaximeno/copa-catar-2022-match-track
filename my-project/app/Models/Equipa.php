<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipa extends Model
{
    use HasFactory;

    protected $table = 'equipes';

    // Retorna os contratos com os jogadores.
    function jogadoresContratados()
    {
        return $this->hasMany(\App\Models\JogadorContratado::class, 'id_equipa');
    }

    // Retorna os confrontos em casa da equipa.
    function confrontosEmCasa()
    {
        return $this->hasMany(\App\Models\Confronto::class, 'id_equipa_casa');
    }

    // Retorna os confrontos em visita da equipa.
    function confrontosEmVisita()
    {
        return $this->hasMany(\App\Models\Confronto::class, 'id_equipa_visita');
    }

    // Retorna todos os confrontos da equipa
    // function confrontos() // TODO
    // {
    // }
}
