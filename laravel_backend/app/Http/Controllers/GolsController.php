<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gol;
use Illuminate\Database\Eloquent\Collection;

class GolsController extends Controller
{
    function formatGol($gol)
    {
        $confronto = $gol->confronto;

        return new Collection([
            'id' => $gol->id,
            'tempo_do_jogo' => $gol->tempo_do_jogo,
            'confronto' => [
                'id' => $confronto->id,
                'local' => $confronto->local,
                'estadio' => $confronto->estadio,
                'dia' => $confronto->dia,
                'equipes' => [
                    'casa' => $confronto->equipaCasa,
                    'visita' => $confronto->equipaVisita,
                ],
            ],
            'equipa' => $gol->jogador->equipa,
            'jogador' => $gol->jogador,
            'detalhes' => $gol->detalhes,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gol::all()->map(function ($gol) {
            return $this->formatGol($gol);
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
        $attrs = $request->only(['tempo_do_jogo', 'id_jogador_em_campo', 'detalhes']);
        return $this->formatGol(Gol::create($attrs));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatGol(Gol::findOrFail($id));
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
        $gol = Gol::findOrFail($id);
        $attrs = $request->only(['tempo_do_jogo', 'id_jogador_em_campo', 'detalhes']);
        $gol->update($attrs);
        return $this->formatGol($gol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gol::findOrFail($id)->delete();
        return response('', 204);
    }
}
