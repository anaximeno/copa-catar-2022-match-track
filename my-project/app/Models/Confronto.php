<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confronto extends Model
{
    use HasFactory;

    protected $table = 'confrontos';

    protected $fillable = [
        'local',
        'inicio',
        'fim',
        'dia',
        'estadio',
        'id_equipa_casa',
        'id_equipa_visita',
        'id_arbitro_principal',
        'rodada',
        'terminou'
    ];

    /** Retorna o árbitro principal do jogo. */
    function arbitro()
    {
        return $this->hasOne(\App\Models\Arbitro::class, 'id', 'id_arbitro_principal');
    }

    /** Retorna a equipe de casa */
    function equipaCasa()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id', 'id_equipa_casa');
    }

    /** Retorna a equipe de visita */
    function equipaVisita()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id', 'id_equipa_visita');
    }

    /** Os jogadores que estão ou estiveram em campo. */
    function jogadoresEmCampo()
    {
        return $this->hasMany(\App\Models\JogadorEmCampo::class, 'id_confronto');
    }
}
