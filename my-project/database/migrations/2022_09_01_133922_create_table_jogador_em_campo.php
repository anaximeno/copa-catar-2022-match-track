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
        Schema::create('jogador_em_campo', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jogador');
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_confronto');
            $table->dateTime('tempo_de_entrada');
            $table->dateTime('tempo_de_saida')->nullable();

            $table->foreign(['id_jogador', 'id_equipa'])
                  ->references(['id_jogador', 'id_equipa'])
                  ->on('jogadores_contratados');

            $table->foreign('id_confronto')
                  ->references('id')
                  ->on('confrontos');

            $table->primary(['id_jogador', 'id_equipa', 'id_confronto']);

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
        Schema::dropIfExists('jogador_em_campo');
    }
};
