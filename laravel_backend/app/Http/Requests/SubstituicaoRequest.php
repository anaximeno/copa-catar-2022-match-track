<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubstituicaoRequest extends FormRequest
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
            'id_jogador_saiu' => 'required|integer|exists:jogadores,id',
            'id_jogador_entrou' => 'required|integer|exists:jogadores,id',
            'id_equipa' => 'required|integer|exists:equipes,id',
            'id_confronto' => 'required|integer|exists:confrontos,id',
        ];
    }
}
