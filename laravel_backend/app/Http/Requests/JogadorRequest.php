<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JogadorRequest extends FormRequest
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
            'nome' => 'required|string|max:60',
            'sobrenome' => 'required|string|max:60',
            'apelido' => 'string|max:40',
            'idade' => 'required|integer|between:16,60',
            'id_equipa' => 'required|integer|exists:equipes,id',
            'posicao' => 'required|string|max:40',
            'numero_camisa' => 'required|integer|between:1,30',
        ];
    }
}
