<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class CrearUsuario
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = new User();
        $user->nombre = $args['nombre'];
        $user->apellidos = $args['apellidos'];
        $user->correo = $args['correo'];
        $user->password = $args['password'];
        $user->telefono = $args['telefono'];
        $user->sexo =$args['sexo'];
        $user->edad = $args['edad'];
        $user->pokebolas = 10;
        $user->save();
        return $user;
    }
    
    
}
