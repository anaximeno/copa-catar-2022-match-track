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
            $table->unsignedBigInteger('id_jogador_em_campo');
            $table->dateTime('tempo_do_jogo');
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
        Schema::dropIfExists('gols');
    }
};
