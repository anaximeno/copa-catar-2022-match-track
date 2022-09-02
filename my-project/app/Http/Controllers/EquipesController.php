<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipa;
use Illuminate\Database\Eloquent\Collection;

class EquipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Equipa::all();
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
        return Equipa::create($attrs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Equipa::findOrFail($id);
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
        return $equipa;
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
