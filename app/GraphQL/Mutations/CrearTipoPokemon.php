<?php

namespace App\GraphQL\Mutations;

use App\Models\Tipo;

class CrearTipoPokemon
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $tipo = new Tipo();
        $tipo->nombre = $args['nombre'];
        $tipo->save();
        return $tipo;
    }
}
