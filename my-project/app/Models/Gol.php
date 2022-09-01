<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gol extends Model
{
    use HasFactory;

    // O jogador que marcou o golo
    function jogador()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador');
    }

    // A equipa que marcou o golo
    function equipa()
    {
        return $this->hasOne(\App\Models\Confronto::class, 'id', 'id_confronto');
    }

    // O confronto decorrente no momento
    function confronto()
    {
        return $this->hasOne(\App\Models\Confronto::class, 'id', 'id_confronto');
    }
}
