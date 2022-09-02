<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Substituicao;

class SubstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Substituicao::all();
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
            'id_jogador_saiu',
            'id_jogador_entrou',
            'id_equipa',
            'id_confronto'
        ]);
        return Substituicao::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Substituicao::findOrFail($id);
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
        $substituicao = Substituicao::findOrFail($id);
        $attrs = $request->only([
            'id_jogador_saiu',
            'id_jogador_entrou',
            'id_equipa',
            'id_confronto'
        ]);
        $substituicao->update($attrs);
        return $substituicao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Substituicao::findOrFail($id)->delete();
        return response('', 204);
    }
}
