<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioPokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_pokemon', function (Blueprint $table) {
            $table->id();
            //nuestra primer llave foranea
            $table->unsignedBigInteger('usuario_id');
            //segunda
            $table->unsignedBigInteger('pokemon_id');

            $table->foreign('usuario_id')->
                references('id')->
                on('usuarios')->
                onUpdate('cascade')->
                onDelete('cascade');

            $table->foreign('pokemon_id')->
                references('id')->
                on('pokemons')->
                onUpdate('cascade')->
                onDelete('cascade');

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
        Schema::dropIfExists('usuario_pokemon');
    }
}
