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
        Schema::create('gols', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tempo_do_jogo');
            $table->unsignedBigInteger('id_jogador');
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_confronto');
            $table->text('detalhes')->nullable();

            $table->foreign(['id_jogador', 'id_equipa', 'id_confronto'])
                  ->references(['id_jogador', 'id_equipa', 'id_confronto'])
                  ->on('jogador_em_campo');

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
        Schema::dropIfExists('gols');
    }
};
