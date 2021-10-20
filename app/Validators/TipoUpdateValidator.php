<?php 

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;

Class TipoUpdateValidator{
    public static function createValidator(Request $request, $id){
        $rules = TipoUpdateValidator::getRules($id);

        
        $validator = FacadesValidator::make($request->all(), $rules);
        return $validator;
    }


    public static function getRules($id){
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