<?php

namespace App\Providers;

use App\Models\Pokemon;
use App\Models\Tipo;
use App\Policies\PokemonPolicy;
use App\Policies\TipoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        //'App\Models\User' =>'App\Policies\UserPolicy'
        User::class => UserPolicy::class,
        Pokemon::class => PokemonPolicy::class,
        Tipo::class => TipoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
