<?php

namespace App\Policies;

use App\Models\Tipo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tipo $tipo)
    {
        //
        return $user->id == $tipo->id;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tipo $tipo)
    {
        //
        return $user->id == $tipo->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tipo $tipo)
    {
        //
        return $user->id == $tipo->id; 
    }

    
}