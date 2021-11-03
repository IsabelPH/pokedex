<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Validators\LoginStoreValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)//post
    {
        $validator = LoginStoreValidator::createValidator($request);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        //primero obtenemos el usuario del correo
        //(Validar que el correo exista en la bd)

        $user = User::where('correo', $request->input('correo'))->get()->first();//collection [usuario]
        //coleccion de un solo elemento 
        //si la coleccion es vacia, el usuario va a ser null

        /***
         * si el usuario es nulo, va devolver error
         * si la contrasena es erronea devuelve error
         */

        if($user == null || !Hash::check($request->input('password'), $user->password)){
            return response()->json([
                "message" => 'usuario o contrasena no validos'
            ]);

        }
        $token = $user->createToken($request->input('dispositivo'));
        return response()->json([
            "data"=>[
                "id" => $user->id,
                "access_token" => $token->plainTextToken
                
            ]
        ]);
     
        
    }

}
