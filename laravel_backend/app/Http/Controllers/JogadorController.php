<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use Illuminate\Database\Eloquent\Collection;

class JogadorController extends Controller
{
    function formatJogador($jogador)
    {
        return new Collection([
            'id' => $jogador->id,
            'nome' => $jogador->nome,
            'sobrenome' => $jogador->sobrenome,
            'apelido' => $jogador->apelido,
            'idade' => $jogador->idade,
            'posicao' => $jogador->posicao,
            'numero_camisa' => $jogador->nome,
            'equipa' => $jogador->equipa,
            'cartoes' => $jogador->cartoes,
            'gols' => $jogador->cartoes,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Jogador::all()->map(function ($jogador) {
            return $this->formatJogador($jogador);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attrs = $request->only(
            ['nome', 'sobrenome', 'apelido', 'idade', 'id_equipa', 'posicao', 'numero_camisa']
        );
        return $this->formatJogador(Jogador::create($attrs));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatJogador(Jogador::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attrs = $request->only(
            ['nome', 'sobrenome', 'apelido', 'idade', 'id_equipa', 'posicao', 'numero_camisa']
        );
        $jogador = Jogador::findOrFail($id);
        $jogador->update($attrs);
        return $this->formatJogador($jogador);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jogador::findOrFail($id)->delete();
        return response('', 204);
    }
}
