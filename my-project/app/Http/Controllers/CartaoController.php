<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartao;

class CartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cartao::all();
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
            ['tempo_do_jogo', 'id_jogador_em_campo', 'detalhes', 'cor']
        );
        return Cartao::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cartao::findOrFail($id);
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
        $cartao = Cartao::findOrFail($id);
        $attrs = $request->only(
            ['tempo_do_jogo', 'id_jogador_em_campo', 'detalhes', 'cor']
        );
        $cartao->update($attrs);
        return $cartao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cartao::findOrFail($id)->delete();
        return response('', 204);
    }
}
