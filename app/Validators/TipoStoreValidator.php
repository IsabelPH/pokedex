<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TipoStoreValidator
{

    public static function createValidator(Request $request)
    {
        $rules = TipoStoreValidator::getRules();

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public static function getRules()
    {
        return [
            
            'nombre'=> 
            [
                'required', 
                'string',
                'max:50'
            ]
             
        ];

    }

}
