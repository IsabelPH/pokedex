<?php

namespace App\GraphQL\Validators\Mutation;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class CrearUsuarioValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'nombre'=>[
                'required',
                'string',
                'max:50'
            ], 
            'apellidos'=> [
                'required', 
                'string',
                'max:50',
            ],
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
