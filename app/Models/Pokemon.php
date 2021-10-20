<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemons';

    protected $fillable = [
        'nombre',
        'peso',
        'tipo_pokemon_id'
    ];

 
    public function usuarios(){
                            //importamos la clase  y la relacion
        return $this->belongsToMany(User::class,'usuario_pokemon');

    }
}
