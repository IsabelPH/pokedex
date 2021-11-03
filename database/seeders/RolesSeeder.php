<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        
        //vamos a hacer uso del query builder
        DB::table('permissions')->delete();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //crear permisos 
        Permission::create(["name" => 'crear pokemons']);
        Permission::create(["name" => 'editar pokemons']);
        Permission::create(["name" => 'ver cualquier pokemon']);
        Permission::create(["name" => 'eliminar pokemons']);
        Permission::create(["name" => 'capturar pokemons']);
        Permission::create(["name" => 'liberar pokemons']);
        Permission::create(["name" => 'ver cualquier tipo de pokemon']);
        Permission::create(["name" => 'ver tipo de pokemon']);
        Permission::create(["name" => 'crear tipos para pokemons']);
        Permission::create(["name" => 'editar cualquier tipo']);
        Permission::create(["name" => 'eliminar cualquier tipo']);
        Permission::create(["name" => 'ver todos los usuarios']);
        
        
        
        
        //verificamos que el rol exista
        if(Role::where('name', 'entrenador')->get()->count() == 0 )
        {
            //creamos los roles
            $entrenador = Role::create(["name" => 'entrenador']);
        } else {
            $entrenador = Role::where('name', 'entrenador')->get()->first();
        }
        //Nota: Son los permisos creados previamente, si no existe le permiso la BD da error 
        //$entrenador->givePermissionTo('capturar pokemons');
        $entrenador->syncPermissions([
            'capturar pokemons',
            'liberar pokemons'
        ]);
        
        //rol superadmin

        if(Role::where('name', 'superadmin')->get()->count() == 0 )
        {
            //creamos los roles
            $superadmin = Role::create(["name" => 'superadmin']);
        } else {
            $superadmin = Role::where('name', 'superadmin')->get()->first();
        }
        //Nota: Son los permisos creados previamente, si no existe le permiso la BD da error 
        //$entrenador->givePermissionTo('capturar pokemons');
        $superadmin->syncPermissions([
            'crear pokemons',
            'editar pokemons',
            'ver cualquier pokemon', 
            'ver tipo de pokemon',
            'eliminar pokemons',
            'ver cualquier tipo de pokemon',
            'crear tipos para pokemons',
            'editar cualquier tipo',
            'eliminar cualquier tipo',
            'ver todos los usuarios'
       
        ]);
            
        if(User::where('correo', 'isabel_admin@ugusoft.com')->get()->count() <0){

            $superadmin = new user();
            $superadmin->nombre = "Isabel";
            $superadmin->apellidos = 'Puente';
            $superadmin->correo = 'isabel_admin@ugusoft.com';
            $superadmin->password = Hash::make('Soyadmin');
                
            $superadmin->telefono = '4981102689';
            $superadmin->sexo = 'mujer';
            $superadmin->edad = '25';
            $superadmin->pokebolas = 10;

            $superadmin->save();
            $superadmin->assignRole('superadmin');
        }
            


    }
}
