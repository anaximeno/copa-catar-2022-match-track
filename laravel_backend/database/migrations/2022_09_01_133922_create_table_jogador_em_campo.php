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
            $table->id();
            $table->unsignedBigInteger('id_jogador');
            $table->unsignedBigInteger('id_confronto');
            $table->dateTime('tempo_de_entrada');
            $table->dateTime('tempo_de_saida')->nullable();

            $table->foreign('id_jogador')
                  ->references('id')
                  ->on('jogadores')
                  ->cascadeOnDelete();

            $table->foreign('id_confronto')
                  ->references('id')
                  ->on('confrontos')
                  ->cascadeOnDelete();

            $table->unique(['id_jogador', 'id_confronto']);

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
