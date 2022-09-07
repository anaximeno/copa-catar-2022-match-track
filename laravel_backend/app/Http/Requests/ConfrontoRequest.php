<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfrontoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'local' => 'required|string|max:80',
            'inicio' => 'required|date',
            'fim' => 'date|required_if:terminou,1,true,"1"',
            'dia' => 'required|date',
            'estadio' => 'required|string|max:60',
            'id_equipa_casa' => 'required|integer|exists:equipes,id|different:id_equipa_visita',
            'id_equipa_visita' => 'required|integer|exists:equipes,id|different:id_equipa_casa',
            'id_arbitro_principal' => 'required|integer|exists:arbitros,id',
            'terminou' => 'boolean',
            'rodada' => 'string|max:40',
        ];
    }
}
