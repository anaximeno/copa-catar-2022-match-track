<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartaoRequest;
use Illuminate\Http\Request;
use App\Models\Cartao;
use Illuminate\Database\Eloquent\Collection;

class CartaoController extends Controller
{
    function formatCartao($cartao)
    {
        $confronto = $cartao->confronto;

        return new Collection([
            'id' => $cartao->id,
            'tempo_do_jogo' => $cartao->tempo_do_jogo,
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
            'equipa' => $cartao->jogador->equipa,
            'jogador' => $cartao->jogador,
            'detalhes' => $cartao->detalhes,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cartao::all()->map(function($cartao) {
            return $this->formatCartao($cartao);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CartaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartaoRequest $request)
    {
        return $this->formatCartao(Cartao::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatCartao(Cartao::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CartaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartaoRequest $request, $id)
    {
        $cartao = Cartao::findOrFail($id);
        $cartao->update($request->validated());
        return $this->formatCartao($cartao);
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
