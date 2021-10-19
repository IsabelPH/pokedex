<?php 

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;

Class UserUpdateValidator{
    public static function createValidator(Request $request, $id){
        $rules = UserUpdateValidator::getRules($id);

        //1./ le vamos a mandar los atributos a validar
        //2./reglas
        $validator = FacadesValidator::make($request->all(), $rules);
        return $validator;
    }


    public static function getRules($id){
        return [
            //arreglo asociativo
            //cadena de texto, nombre del campo
            'nombre'=> 'sometimes|required|string|max:50', 
            'apellidos'=> 'sometimes|required|string|max:50',
            'correo'=> [
                'sometimes',// no es obligatoria que este presente el campo
                'required', // no puede ser nulo
                'email', 
                Rule::unique('usuarios','correo')->ignore($id)
            ],
            'telefono'=>[
                'sometimes',
                'required',
                'numeric',
                Rule::unique('usuarios','telefono')->ignore($id)
            ],
            'sexo' =>[
                'sometimes',
                'required', 
                'string',
                'max:10'
            ],   
            'edad'=>[
                'sometimes',
                'required',
                'string', 
                'integer'
            ]


        ];
    }
}