<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogadorEmCampo extends Model
{
    use HasFactory;

    protected $table = 'jogador_em_campo';

    // Retorna o confronto em que o jogador está participando
    function confronto()
    {
        return $this->hasOne(\App\Models\Confronto::class, 'id', 'id_confronto');
    }
}
