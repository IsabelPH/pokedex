<?php

namespace App\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;

class CrearPokemonValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'nombre'=> [
                'required',
                'string',
                'max:50',
            ],   
            'peso'=>[
                'required',
                'string'
            ],
            'tipo_pokemon_id'=>[
                'exists:App\Models\Tipo,id'
            ]
        ];
    }
}
