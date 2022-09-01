<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $table = 'cartoes';

    // O jogador que recebeu o cartão
    function jogador()
    {
        return $this->hasOne(\App\Models\Jogador::class, 'id', 'id_jogador');
    }

    // A equipa que recebeu cartão
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
