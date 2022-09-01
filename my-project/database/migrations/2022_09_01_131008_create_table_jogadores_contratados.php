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
        Schema::create('jogadores_contratados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_equipa');
            $table->unsignedBigInteger('id_jogador');
            $table->foreign('id_equipa')
                  ->references('id')
                  ->on('equipes');
            $table->foreign('id_jogador')
                  ->references('id')
                  ->on('jogadores');
            $table->primary(['id_equipa', 'id_jogador']);
            $table->dateTime('inicio_do_contrato');
            $table->dateTime('fim_do_contrato')->nullable();
            $table->tinyInteger('numero_da_camisa');
            $table->string('posicao'); // NOTE: poderia ser extraído à sua tabela
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
        Schema::dropIfExists('jogadores_contratados');
    }
};
