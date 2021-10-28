<?php

namespace App\Policies;

use App\Models\Tipo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class TipoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('ver cualquier tipo de pokemon');
        //cualquier tipo
    }


    public function view(User $user, Tipo $tipo)
    {
        //
        if($user->hasPermissionTo('ver tipo de pokemon')){
            return true;
        }
        
        
    }


    public function create(User $user){
        //crear tipo
        return $user->hasPermissionTo('crear tipos para pokemons');
    }

    public function update(User $user, Tipo $tipo)
    {
        //editar tipo
        return $user->hasPermissionTo('editar cualquier tipo');
    }


    public function delete(User $user, Tipo $tipo)
    {
        //eliminar cualquier tipo
        return $user->hasPermissionTo('eliminar cualquier tipo');
    }

   
}
