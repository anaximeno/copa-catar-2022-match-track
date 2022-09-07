<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use App\Http\Requests\ArbitroRequest;

class ArbitroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Arbitro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArbitroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArbitroRequest $request)
    {
        return Arbitro::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Arbitro::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArbitroRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArbitroRequest $request, $id)
    {
        $arbitro = Arbitro::findOrFail($id);
        $attrs = $request->validated();
        $arbitro->update($attrs);
        return $arbitro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Arbitro::findOrFail($id)->delete();
        return response('', 204);
    }

    /**
     * Mostra todos os confrontos em que o árbitro participou.
     */
    public function confrontos($id_equipa)
    {
        return Arbitro::findOrFail($id_equipa)->confrontos;
    }

    /**
     * Mostra todos um confronto específico em que o árbitro participou.
     */
    public function confronto($id_equipa, $id)
    {
        return Arbitro::findOrFail($id_equipa)
                      ->confrontos()
                      ->where('id', $id)
                      ->first();
    }
}
