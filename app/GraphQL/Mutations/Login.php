<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Hash;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {

        
        $user = User::where('correo', $args['correo'])->get()->first();
        if($user == null || !Hash::check($args['password'], $user->password)){
            throw new Error(" La contrasena o el usuario son incorrectos");
        }
        $token = $user->createToken($args['dispositivo']);

        return [
            'usuario'=> $user,
            'accessToken' => $token->plainTextToken
        ];

    }
}
