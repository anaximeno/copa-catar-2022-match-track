<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gol;

class GolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gol::all();
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
        return Gol::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gol::findOrFail($id);
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
        return $gol;
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
