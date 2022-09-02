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
}
