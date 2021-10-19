<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validators\UserStoreValidator;
use App\Validators\UserUpdateValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{   

    // constructor

    //?
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*** public function create()
    {
        //
        return ('funciona');
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//post
    {
        $validator = UserStoreValidator::createValidator($request);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        //
        
        $user = new user();
        $user->nombre = $request->input('nombre');
        $user->apellidos = $request->input('apellidos');
        $user->correo = $request->input('correo');
        $user->password = $request->input('password');
        $user->telefono = $request->input('telefono');
        $user->sexo = $request->input('sexo');
        $user->edad = $request->input('edad');
        $user->pokebolas = 10;

        $user->save();

        //return $user;
        return response()->json([
            "data" => $user -> toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($usuario_id)
    {
        //validator se usa en un formulario

        //Validamos que el id sea correcto
        $user = User::find($usuario_id);
        if($user == null){
            return response()->json([
                'message' => 'El usuario no existe'
            ], 404);
        }
        return $user->toJson();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        //Log::debug('hola update');
        //quizas
        $user = User::find($user_id);
        if($user == null){
            return response()->json([
                'message' => 'El usuario no existe'
            ], 404);
        }
        
        $validator = UserUpdateValidator::createValidator($request,$user_id);//con esto creamos el validator
        //ejecutamos validator
        if($validator->fails()){
            return response()->json([
                'message' => 'error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        ///
        if($request->exists("nombre")){
            $user->nombre = $request->input('nombre');
        }
        if($request->exists('apellidos')){
            $user->apellidos = $request->input('apellidos');
            dd("no se puede");
        }
        if($request->has('correo')){
            $user->correo = $request->input('correo');
        }
        if($request->has('telefono')){
            $user->telefono = $request->input('telefono');
        }
        if($request->has('sexo')){
            $user->sexo = $request->input('sexo');
        }
        if($request->has('edad')){
            $user->edad = $request->input('edad');
        }

        $user->save();

        return  response()->json([
            "data" => $user -> toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if($user == null){
            return response()->json([
                'message' => 'El usuario no existe'
            ], 404);
        }
        $user->delete();

        return response()->json(null, 204);
    }
}