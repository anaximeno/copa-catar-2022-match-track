<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipa;
use Illuminate\Database\Eloquent\Collection;

class EquipesController extends Controller
{
    function formatEquipa($equipa)
    {
        $golsFilter = function ($gol) use (&$equipa) {
            return $gol->jogador->id_equipa == $equipa->id;
        };

        $cartoesFilter = function ($cartao) use (&$equipa) {
            return $cartao->jogador->id_equipa == $equipa->id;
        };

        $confrontoToGolsReducer = function ($carry, $confronto) {
            return $carry->merge($confronto->gols);
        };

        $confrontoToCartoesReducer = function ($carry, $confronto) {
            return $carry->merge($confronto->cartoes);
        };

        $gols = array_values($equipa->confrontosEmCasa
            ->merge($equipa->confrontosEmVisita)
            ->reduce($confrontoToGolsReducer, new Collection([]))
            ->filter($golsFilter)
            ->toArray());

        $cartoes = array_values($equipa->confrontosEmCasa
            ->merge($equipa->confrontosEmVisita)
            ->reduce($confrontoToCartoesReducer, new Collection([]))
            ->filter($cartoesFilter)
            ->toArray());

        return new Collection([
            'id' => $equipa->id,
            'nome' => $equipa->nome,
            'simbolo' => $equipa->simbolo,
            'local_pertencente' => $equipa->local_pertencente,
            'jogadores' => $equipa->jogadores,
            'gols' => $gols,
            'substituicoes' => $equipa->substituicoes,
            'cartoes' => $cartoes,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Equipa::all()->map(function ($equipa) {
            return $this->formatEquipa($equipa);
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
        $attrs = $request->only(['nome', 'simbolo', 'local_pertencente']);
        return $this->formatEquipa(Equipa::create($attrs));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatEquipa(Equipa::findOrFail($id));
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
        $equipa = Equipa::findOrFail($id);
        $attrs = $request->only(['nome', 'simbolo', 'local_pertencente']);
        $equipa->update($attrs);
        return $this->formatEquipa($equipa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipa::findOrFail($id)->delete();
        return response('', 204);
    }

    /**
     * Mostra todos os jogadores da equipe.
     */
    public function jogadores($id_equipa)
    {
        return Equipa::findOrFail($id_equipa)->jogadores;
    }

    /**
     * Mostra um jogador específico da Equipe.
     */
    public function jogador($id_equipa, $id)
    {
        return Equipa::findOrFail($id_equipa)
            ->jogadores()
            ->where('id', $id)
            ->first();
    }

    /**
     * Mostra todos os confrontos da equipe.
     */
    public function confrontos($id_equipa)
    {
        $equipa = Equipa::findOrFail($id_equipa);

        return new Collection([
            'casa' => $equipa->confrontosEmCasa()->get(),
            'visita' => $equipa->confrontosEmVisita()->get()
        ]);
    }
}
