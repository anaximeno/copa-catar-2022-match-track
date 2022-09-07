<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfrontoRequest;
use Illuminate\Http\Request;
use App\Models\Confronto;
use Illuminate\Database\Eloquent\Collection;

class ConfrontoController extends Controller
{
    function formatEquipaEmConfronto($equipa, $confronto)
    {
        $jogadores = $confronto->jogadoresEmCampo()->get()
            ->map(function ($jogadorEmCampo) {
                return $jogadorEmCampo->jogador;
            })
            ->filter(function ($jogador) use (&$equipa) {
                return $jogador->id_equipa == $equipa->id;
            });

        $gols = $confronto->gols->filter(function ($gol) use (&$equipa) {
            return $gol->jogador->id_equipa == $equipa->id;
        });

        $cartoes = $confronto->cartoes->filter(function ($cartao) use (&$equipa) {
            return $cartao->jogador->id_equipa == $equipa->id;
        });

        $substituicoes = $confronto->substituicoes->where('id_equipa', $equipa->id);

        return new Collection([
            'id' => $equipa->id,
            'nome' => $equipa->nome,
            'simbolo' => $equipa->simbolo,
            'local_pertencente' => $equipa->local_pertencente,
            'jogadores_em_campo' => $jogadores,
            'gols' => $gols,
            'substituicoes' => $substituicoes,
            'cartoes' => $cartoes,
        ]);
    }

    function formatConfronto($confronto)
    {
        return new Collection([
            'id' => $confronto->id,
            'local' => $confronto->local,
            'dia' => $confronto->dia,
            'inicio' => $confronto->inicio,
            'fim' => $confronto->fim,
            'rodada' => $confronto->rodada,
            'estadio' => $confronto->estadio,
            'local' => $confronto->local,
            'arbitro' => $confronto->arbitro,
            'terminou' => $confronto->terminou,
            'equipes' => [
                'casa' => $this->formatEquipaEmConfronto($confronto->equipaCasa, $confronto),
                'visita' => $this->formatEquipaEmConfronto($confronto->equipaVisita, $confronto),
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Confronto::all()->map(function ($confronto) {
            return $this->formatConfronto($confronto);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ConfrontoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfrontoRequest $request)
    {
        return $this->formatConfronto(Confronto::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatConfronto(Confronto::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ConfrontoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfrontoRequest $request, $id)
    {
        $confronto = Confronto::findOrFail($id);
        $confronto->update($request->validated());
        return $this->formatConfronto($confronto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Confronto::findOrFail($id)->delete();
        return response('', 204);
    }
}
