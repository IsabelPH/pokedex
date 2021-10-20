<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PokemonStoreValidator
{

    public static function createValidator(Request $request)
    {
        $rules = PokemonStoreValidator::getRules();

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public static function getRules()
    {
        return [
            
            'nombre'=> 'required|string|max:50',   
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
