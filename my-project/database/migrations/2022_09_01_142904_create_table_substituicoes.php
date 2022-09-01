<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substituicoes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jogador_sai');
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_confronto');
            $table->unsignedBigInteger('id_jogador_entra');
            $table->dateTime('tempo_de_jogo');

            $table->foreign(['id_jogador_sai', 'id_equipa', 'id_confronto'], 'fk_jogador_substituido')
                  ->references(['id_jogador', 'id_equipa', 'id_confronto'])
                  ->on('jogador_em_campo');

            $table->foreign(['id_jogador_entra', 'id_equipa'], 'fk_jogodar_entra_em_campo')
                ->references(['id_jogador', 'id_equipa'])
                ->on('jogadores_contratados');

            // NOTE: Aqui a coluna id_equipa vai ter duas restrições de chave estrangeira,
            // - Uma com a tabela jogador_em_campo
            // - Outra com a tabela jogadores_contratados
            // Sendo assim, a equipe do jogador que sai de campo deve ser do mesmo tipo do que entra.

            $table->primary(
                ['id_jogador_sai', 'id_equipa', 'id_confronto', 'id_jogador_entra'],
                'pk_substituicao_de_jogador_em_campo'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('substituicoes');
    }
};
