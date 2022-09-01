<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confronto;

class ConfrontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Confronto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attrs = $request->only([
            'local',
            'inicio',
            'fim',
            'dia',
            'estadio',
            'id_equipa_casa',
            'id_equipa_visita',
            'id_arbitro_principal',
            'terminou',
            'rodada',
        ]);
        return Confronto::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Confronto::findOrFail($id);
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
        $confronto = Confronto::findOrFail($id);
        $attrs = $request->only([
            'local',
            'inicio',
            'fim',
            'dia',
            'estadio',
            'id_equipa_casa',
            'id_equipa_visita',
            'id_arbitro_principal',
            'terminou',
            'rodada',
        ]);
        $confronto->update($attrs);
        return $confronto;
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
