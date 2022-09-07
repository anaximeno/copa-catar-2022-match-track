<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubstituicaoRequest;
use Illuminate\Http\Request;
use App\Models\Substituicao;
use Illuminate\Database\Eloquent\Collection;

class SubstituicaoController extends Controller
{
    function formatSubstituicao($substituicao)
    {
        $confronto = $substituicao->confronto;

        return new Collection([
            'id' => $substituicao->id,
            'saiu' => $substituicao->jogadorQueSaiu,
            'entrou' => $substituicao->jogadorQueEntrou,
            'equipa' => $substituicao->equipa,
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
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Substituicao::all()->map(function($substituicao) {
            return $this->formatSubstituicao($substituicao);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubstituicaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubstituicaoRequest $request)
    {
        return $this->formatSubstituicao(Substituicao::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatSubstituicao(Substituicao::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubstituicaoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubstituicaoRequest $request, $id)
    {
        $substituicao = Substituicao::findOrFail($id);
        $substituicao->update($request->validated());
        return $this->formatSubstituicao($substituicao);
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
