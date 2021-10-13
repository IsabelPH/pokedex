<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('peso');
            $table->string('foto');//

            //usuario
            $table->unsignedBigInteger('usuario_id');    
            $table->foreign('usuario_id')
                ->references('id') 
                ->on('usuarios') //cual tabla es la padre?
                ->onUpdate('cascade') //que pasa si se actualiza el id del padre?
                ->onDelete('cascade'); //que pasa si se elimina el padre
            //tipo pokemon
            $table->unsignedBigInteger('tipo_pokemon_id');    
            $table->foreign('tipo_pokemon_id')
                ->references('id') 
                ->on('tipo_pokemons') //cual tabla es la padre?
                ->onUpdate('cascade') //que pasa si se actualiza el id del padre?
                ->onDelete('cascade'); //que pasa si se elimina el padre
                    
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
        Schema::dropIfExists('pokemons');
    }
}
