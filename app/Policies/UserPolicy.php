<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class UserPolicy
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
        return $user->hasPermissionTo('ver todos los usuarios');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        //solo el usuario dueno va a poder ver sus propios datos
        // cosas por hacer: comprobar  si el usuario es admin  
        if($user->hasPermissionTo('ver  solo un usuario')){
            return true;
        }
        $resultado = DB::table("usuarios")->
            select('*')->
            where('id', $user->id)->get();
        return $resultado->count()>0;
        //return $user->id  == $model->id;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {

        return $user->hasPermissionTo('modificar un  usuario');
        //return $user->id  == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('eliminar el usuario');
        //return $user->id  == $model->id;
    }

   
}
