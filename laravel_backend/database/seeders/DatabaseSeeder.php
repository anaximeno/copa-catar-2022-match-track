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
use App\Models\Substituicao;

class DatabaseSeeder extends Seeder
{
    private function seedEquipa()
    {
        return Equipa::factory(1)->has(
            Jogador::factory(22)->state(function($attributes, Equipa $equipa) {
                return [ 'id_equipa' => $equipa->id ];
            }),
            'jogadores'
        )->create();
    }

    /** Evento `aleatório` com a probabilidade de laplace de $num/$denum */
    private function prob(int $num, int $denum)
    {
        return (fake()->numberBetween(0, $denum) < $num);
    }

    private function seed()
    {
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
                if ($this->prob(22, 90)) { // `22/90` -> chance hipotética de marcar um golo
                    $gol = Gol::factory(1)->state([
                        'id_jogador_em_campo' => $jogadorEmCampo->id,
                    ])->create()->first();
                }
            }

            if ($this->prob(11, 90)) { // `11/90` -> chance hipotética de receber um cartao
                $gol = Cartao::factory(1)->state([
                    'id_jogador_em_campo' => $jogadorEmCampo->id,
                ])->create()->first();
            }

            return $jogadorEmCampo;
        };

        $fazerSubstituicao = function($equipa, $jogador1, $jogador2) use(&$confronto) {
            //assert($jogador1->id_equipa == $jogador2->id_equipa);
            if ($this->prob(2, 22)) {
                $subtituicao = Substituicao::factory(1)->state([
                    'id_jogador_saiu' => $jogador1->id,
                    'id_jogador_entrou' => $jogador2->id,
                    'id_equipa' => $equipa->id,
                    'id_confronto' => $confronto->id,
                ])->create()->first();
            }
        };

        $limit = min(count($equipa1->jogadores), count($equipa2->jogadores));
        for ($i = 0 ; $i < $limit ; $i += 1) {
            $criarJogadorEmCampo($equipa1->jogadores[$i]);
            $criarJogadorEmCampo($equipa2->jogadores[$i]);

            if ($i + 1 < $limit) {
                $fazerSubstituicao($equipa1, $equipa1->jogadores[$i], $equipa1->jogadores[$i + 1]);
                $fazerSubstituicao($equipa2, $equipa2->jogadores[$i], $equipa2->jogadores[$i + 1]);
            }
        }
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0 ; $i < 10 ; $i += 1) {
            $this->seed();
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
