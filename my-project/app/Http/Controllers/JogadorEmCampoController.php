<?php

namespace App\Http\Controllers;

use App\Models\JogadorEmCampo;
use Illuminate\Http\Request;

class JogadorEmCampoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_confronto)
    {
        return JogadorEmCampo::all()->where('id_confronto', $id_confronto);
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
        return JogadorEmCampo::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_confronto, $id)
    {
        return JogadorEmCampo::findOrFail($id);
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
        return $jogadorEmCampo;
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
