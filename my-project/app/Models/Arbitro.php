<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    use HasFactory;

    protected $table = 'arbitros';

    protected $fillable = [
        'nome',
        'sobrenome',
        'idade'
    ];

    /** Retorna os confrontos em que o árbitro participou. */
    function confrontos()
    {
        return $this->hasMany(\App\Models\Arbitro::class, 'id_arbitro_principal');
    }
}
