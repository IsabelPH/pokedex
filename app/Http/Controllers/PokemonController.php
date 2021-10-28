<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Validators\PokemonStoreValidator;
use App\Validators\PokemonUpdateValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PokemonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
    }
    /**  
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // usuario autenticado y recurso
        if($user->cant('viewAny',Pokemon::class )){
            //Log::debug('cant');
            return response()->json([
                "message" => 'El usuarion no esta autorizado para esta accion viewAny '
            ], 403);
        }
        return Pokemon::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = PokemonStoreValidator::createValidator($request);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        $user = Auth::user();
        // usuario autenticado y recurso
        if($user->cant('create',Pokemon::class )){
            Log::debug('cant');
            return response()->json([
                "message" => 'El usuarion no esta autorizado para esta accion viewAny '
            ], 403);
        }

        $pokemons = new Pokemon();
        $pokemons->nombre = $request->input('nombre');
        $pokemons->peso = $request->input('peso');
        $pokemons->tipo_pokemon_id = $request->input('tipo_pokemon_id');

        $pokemons->save();

        return response()->json([
          "data" => $pokemons -> toArray()
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($pokemon_id)
    {
        $pokemons = Pokemon::find($pokemon_id);
        if($pokemons == null){
            return response()->json([
                'message' => 'El pokemon no existe'
            ], 404);
        }
        $authUser = Auth::user();
        // usuario autenticado y recurso
        if($authUser->cant('view',$pokemons )){
            return response()->json([
                "message" => 'El usuario no esta autorizado para esta accion.'
            ], 403);
        }
        return $pokemons->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update(Request $request, $pokemon_id)
    {        
        $pokemons = Pokemon::find($pokemon_id);

        if($pokemons == null){
            return response()->json([
                'message' => 'El pokemon no existe'
            ], 404);
        }
        $user = Auth::user();
        // usuario autenticado y recurso
        if($user->cant('update',$pokemons)){
            //Log::debug('cant');
            return response()->json([
                "message" => 'El usuario no esta autorizado para esta accion. '
            ], 403);
        }
        

        $validator = PokemonUpdateValidator::createValidator($request, $pokemon_id);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        if($request->exists("nombre")){
            $pokemons->nombre = $request->input('nombre');
        }
        if($request->exists("peso")){
            $pokemons->peso = $request->input('peso');
        }
        if($request->exists("tipo_pokemon_id")){
            $pokemons->tipo_pokemon_id = $request->input('tipo_pokemon_id');
        }
        
        $pokemons->save();
        //
        return response()->json([
            'data'=> $pokemons->toArray()
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($pokemon_id)
    {
        $pokemons = Pokemon::find($pokemon_id);
        if($pokemons == null){
            return response()->json([
                'message' => 'El pokemon no existe'
            ], 404);
        }
        $user = Auth::user();
        // usuario autenticado y recurso
        if($user->cant('delete', $pokemons)){
            //Log::debug('cant');
            return response()->json([
                "message" => 'El usuarion no esta autorizado para esta accion '
            ], 403);
        }

        $pokemons->delete();

        return response()->json(null, 204);
    }
    
}
