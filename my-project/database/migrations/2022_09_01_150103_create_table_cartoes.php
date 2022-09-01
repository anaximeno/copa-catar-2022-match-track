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
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tempo_do_jogo');
            $table->string('cor'); // Poderia ser extraido à sua tabela
            $table->unsignedBigInteger('id_jogador');
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_confronto');
            $table->unsignedBigInteger('id_arbitro');
            $table->text('detalhes');

            $table->foreign(['id_jogador', 'id_equipa', 'id_confronto'])
                  ->references(['id_jogador', 'id_equipa', 'id_confronto'])
                  ->on('jogador_em_campo');

            $table->foreign('id_arbitro')
                  ->references('id')
                  ->on('arbitros');

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
        Schema::dropIfExists('cartoes');
    }
};
