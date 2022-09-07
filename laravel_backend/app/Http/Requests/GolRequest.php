<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GolRequest extends FormRequest
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
            'tempo_do_jogo' => 'required|date',
            'id_jogador_em_campo' => 'required|integer|exists:jogador_em_campo,id',
            'detalhes' => 'string|max:100',
        ];
    }
}
