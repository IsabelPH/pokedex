<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PokemonUpdateValidator
{

    public static function createValidator(Request $request)
    {
        $rules = PokemonUpdateValidator::getRules();

        //1./ le vamos a mandar los atributos a validar
        //2./reglas
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public static function getRules()
    {
        return [
            //arreglo asociativo
            //cadena de texto, nombre del campo
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
