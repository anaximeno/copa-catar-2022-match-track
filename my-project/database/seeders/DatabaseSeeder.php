<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Arbitro;
use App\Models\Cartao;
use App\Models\Confronto;
use Illuminate\Database\Seeder;
use App\Models\Equipa;
use App\Models\Gol;
use App\Models\Jogador;
use App\Models\JogadorEmCampo;

class DatabaseSeeder extends Seeder
{
    private function seedEquipa() {
        return Equipa::factory(1)->has(
            Jogador::factory(22)->state(function($attributes, Equipa $equipa) {
                return [ 'id_equipa' => $equipa->id ];
            }),
            'jogadores'
        )->create();
    }

    private function seed() {
        $arbitro = Arbitro::factory(1)->create()->first();
        $equipa1 = $this->seedEquipa()->first();
        $equipa2 = $this->seedEquipa()->first();
        $confronto = Confronto::factory(1)->state([
            'id_equipa_casa' => $equipa1->id,
            'id_equipa_visita' => $equipa2->id,
            'id_arbitro_principal' => $arbitro->id,
        ])->create()->first();

        $criarJogadorEmCampo = function($jogador) use (&$confronto) {
            $jogadorEmCampo = JogadorEmCampo::factory(1)->state([
                'id_jogador' => $jogador->id,
                'id_confronto' => $confronto->id,
            ])->create()->first();

            for ($i = 0 ; $i < 4 ; $i += 1) {
                if (fake()->numberBetween(0, 90) < 22) { // `22/90` -> chance hipotética de marcar um golo
                    $gol = Gol::factory(1)->state([
                        'id_jogador_em_campo' => $jogadorEmCampo->id,
                    ])->create()->first();
                }
            }

            if (fake()->numberBetween(0, 90) < 11) { // `11/90` -> chance hipotética de receber um cartao
                $gol = Cartao::factory(1)->state([
                    'id_jogador_em_campo' => $jogadorEmCampo->id,
                ])->create()->first();
            }

            return $jogadorEmCampo;
        };

        $limit = min(count($equipa1->jogadores), count($equipa2->jogadores));
        for ($i = 0 ; $i < $limit ; $i += 1) {
            $criarJogadorEmCampo($equipa1->jogadores[$i]);
            $criarJogadorEmCampo($equipa2->jogadores[$i]);
        }
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seed();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
