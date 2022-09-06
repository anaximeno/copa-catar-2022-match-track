<?php

namespace App\Http\Controllers;

use App\Models\JogadorEmCampo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class JogadorEmCampoController extends Controller
{
    function formatJogadorEmCampo($jogadorEmCampo)
    {
        $jogador = $jogadorEmCampo->jogador;
        $confronto = $jogadorEmCampo->confronto;

        $equipaDoJogador = ($jogador->equipa == $confronto->equipaCasa)
            ? 'casa'
            : 'visita';

        return new Collection([
                'id' => $jogador->id,
                'nome' => $jogador->nome,
                'sobrenome' => $jogador->sobrenome,
                'apelido' => $jogador->apelido,
                'idade' => $jogador->idade,
                'posicao' => $jogador->posicao,
                'numero_camisa' => $jogador->numero_camisa,
                'equipaDoJogador' => $equipaDoJogador,
                'cartoes' => $jogadorEmCampo->cartoes,
                'gols' => $jogadorEmCampo->gols,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_confronto)
    {
        $jogadores = JogadorEmCampo::all()->where('id_confronto', $id_confronto);
        return $jogadores->map(function ($jogadorEmCampo) {
            return $this->formatJogadorEmCampo($jogadorEmCampo);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_confronto)
    {
        $attrs = $request->only(['id_jogador', 'tempo_de_entrada', 'tempo_de_saida']);
        $attrs['id_confronto'] = $id_confronto;
        return $this->formatJogadorEmCampo(JogadorEmCampo::create($attrs));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_confronto, $id)
    {
        return $this->formatJogadorEmCampo(JogadorEmCampo::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_confronto, $id)
    {
        $jogadorEmCampo = JogadorEmCampo::findOrFail($id);
        $attrs = $request->only(['id_jogador', 'tempo_de_entrada', 'tempo_de_saida']);
        $attrs['id_confronto'] = $id_confronto;
        $jogadorEmCampo->update($attrs);
        return $this->formatJogadorEmCampo($jogadorEmCampo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_confronto, $id)
    {
        JogadorEmCampo::findOrFail($id)->delete();
        return response('', 204);
    }
}
