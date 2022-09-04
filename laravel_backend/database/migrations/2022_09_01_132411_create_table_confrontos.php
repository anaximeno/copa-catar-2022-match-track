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
        Schema::create('confrontos', function (Blueprint $table) {
            $table->id();
            $table->string('local');
            $table->date('dia');
            $table->dateTime('inicio');
            $table->dateTime('fim')->nullable();
            $table->string('estadio'); // poderia ser extraído à sua tabela
            $table->string('rodada')->nullable(); // poderia ser extraído à sua tabela
            $table->unsignedBigInteger('id_equipa_casa');
            $table->unsignedBigInteger('id_equipa_visita');
            $table->unsignedBigInteger('id_arbitro_principal');
            $table->boolean('terminou')->default(false);

            $table->foreign('id_equipa_casa')
                  ->references('id')
                  ->on('equipes')
                  ->cascadeOnDelete();

            $table->foreign('id_equipa_visita')
                  ->references('id')
                  ->on('equipes')
                  ->cascadeOnDelete();

            $table->foreign('id_arbitro_principal')
                  ->references('id')
                  ->on('arbitros')
                  ->cascadeOnDelete();

            $table->timestamps();
        });

        // TODO: check id_equipa_casa != id_equipa_visita
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confrontos');
    }
};
