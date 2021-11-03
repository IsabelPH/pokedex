<?php

namespace App\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;

class LoginValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            
            'dispositivo'=> [
                'required',
                'string',
                'max:50', 
            ],
            'correo'=> [
                'required',
                'email'
            ],
            'password'=>[
                'required',
                'string',
                'min:6'
            ]
             
        ];
    }
}
