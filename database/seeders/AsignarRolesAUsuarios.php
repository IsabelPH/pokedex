<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AsignarRolesAUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = User::all(); 
        /***for($x=0;$x<$usuarios->count();$x++){
            $usuario = $usuarios->get($x);
            $usuario->assignRole('entrenador');
        }   */
        foreach($usuarios as $usuario){
            $usuario->assignRole('entrenador');
        }
        //regresa el indice actual
        //el each no permite modificar el la coleccion
        //si queremos modificar algun elemento de la coleccion debemos utilizar otro
        //metodo que es map
        /**$usuarios->each(function($usuario, $key){
            $usuario->assignRole('entrenador');
        });*/
    }
}
