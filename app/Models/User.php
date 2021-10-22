<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',    
        'apellidos',
        'correo',
        'password',  
        'telefono', 
        'sexo', 
        'edad', 
        'pokebolas'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //el modelo puede tener relaciones con direfentes nombres pokemons
    public function pokemons(){
        //
        return $this->belongsToMany(Pokemon::class,'usuario_pokemon');
    }

    public function test_task_list_can_be_retrieved()
{
    Sanctum::actingAs(
        User::factory()->create(),
        ['view-tasks']
    );

    $response=$this->get('/api/task');

    $response->assertOk();
}
}
