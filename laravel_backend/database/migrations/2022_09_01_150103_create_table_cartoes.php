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
            $table->unsignedBigInteger('id_jogador_em_campo');
            $table->string('cor', 12); // poderia ser extraído à sua tabela
            $table->text('detalhes')->nullable();

            $table->foreign('id_jogador_em_campo')
                  ->references('id')
                  ->on('jogador_em_campo')
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
        Schema::dropIfExists('cartoes');
    }
};
