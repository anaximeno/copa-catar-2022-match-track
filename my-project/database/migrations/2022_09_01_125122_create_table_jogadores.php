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
        Schema::create('jogadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('apelido')->nullable();
            $table->unsignedTinyInteger('idade');
            $table->unsignedBigInteger('id_equipa');
            $table->string('posicao'); // pode ser extraido
            $table->unsignedTinyInteger('numero_camisa');

            $table->foreign('id_equipa')
                  ->references('id')
                  ->on('equipes')
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
        Schema::dropIfExists('jogadores');
    }
};
