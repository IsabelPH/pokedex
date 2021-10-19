<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserStoreValidator
{

    public static function createValidator(Request $request)
    {
        $rules = UserStoreValidator::getRules();

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
            'apellidos'=> 'required|string|max:50',
            'correo'=> [
                'required',
                'email', 
                'unique:usuarios,correo',
            ],
            'telefono'=>[
                'required',
                'numeric',
                Rule::unique('usuarios','telefono')
            ],
            'sexo' =>[
                'required', 
                'string',
                'max:10'
            ],   
            'edad'=>[
                'required',
                'string', 
                'integer'
            ],
            'password'=>[
                'required',
                'string',
                'min:6'
            ]

             
        ];

    }

}
