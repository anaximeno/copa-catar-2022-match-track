<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substituicao extends Model
{
    use HasFactory;

    protected $table = 'substituicoes';

    protected $fillable = [
        'tempo_de_jogo',
    ];

    /** O jogador que saiu */
    function jogadorQueSaiu()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador_sai');
    }

    /** O jogador que entrou */
    function jogadorQueEntrou()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador_entra');
    }

    /** A equipa em que a substituição foi feita */
    function equipa()
    {
        return $this->hasOne(\App\Models\Equipa::class, 'id', 'id_equipa');
    }

    /** O confronto em decorrimento no momento da substituição */
    function confronto()
    {
        return $this->hasOne(\App\Models\Confronto::class, 'id', 'id_confronto');
    }
}
