<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginStoreValidator
{

    public static function createValidator(Request $request)
    {
        $rules = LoginStoreValidator::getRules();

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public static function getRules()
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