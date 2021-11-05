<?php

namespace App\GraphQL\Mutations;

use App\Models\Pokemon;

class CrearPokemon
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $pokemon = new Pokemon();
        $pokemon->nombre = $args['nombre'];
        $pokemon->peso = $args['peso'];
        //$pokemon->tipo = $args['tipo'];
        $pokemon->tipo_pokemon_id = $args['TipoPokemon'];
        
        $pokemon->save();

        return $pokemon;
        
    }
}
