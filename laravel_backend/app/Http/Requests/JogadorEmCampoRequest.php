<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JogadorEmCampoRequest extends FormRequest
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
            'id_jogador' => 'required|integer|exists:jogadores,id',
            // 'id_confronto' => /* NOTA: adicionado automáticamente. */
            'tempo_de_entrada' => 'required|date',
            'tempo_de_saida' => 'date',
        ];
    }
}
