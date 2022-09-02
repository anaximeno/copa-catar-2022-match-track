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
            $table->id();
            $table->unsignedBigInteger('id_jogador_saiu');
            $table->unsignedBigInteger('id_jogador_entrou');
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_confronto');
            $table->dateTime('tempo_do_jogo');

            $table->foreign('id_jogador_saiu')
                  ->references('id')
                  ->on('jogadores')
                  ->cascadeOnDelete();

            $table->foreign('id_jogador_entrou')
                  ->references('id')
                  ->on('jogadores')
                  ->cascadeOnDelete();

            $table->foreign('id_equipa')
                  ->references('id')
                  ->on('equipes')
                  ->cascadeOnDelete();

            $table->foreign('id_confronto')
                  ->references('id')
                  ->on('confrontos')
                  ->cascadeOnDelete();

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
