<?php

namespace App\Policies;

use App\Models\Pokemon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class PokemonPolicy
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
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pokemon $pokemon)
    {
        $resultados = DB::table('usuario_pokemon')->
            select('*')->
            where('usuario_id', $user->id)->
            where('pokemon_id', $pokemon->id)->get();
                
        return $resultados->count() > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pokemon $pokemon)
    {
        //
        return $user->id  == $pokemon->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pokemon $pokemon)
    {
        //
        return $user->id  == $pokemon->id;
    }

    
}
