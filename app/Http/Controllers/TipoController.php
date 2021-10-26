<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Validators\TipoStoreValidator;
use App\Validators\TipoUpdateValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoController extends Controller
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
        return response()->json([
            "data" => Tipo::all()
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = TipoStoreValidator::createValidator($request);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }

        $tipos = new Tipo(); 
        $tipos->nombre = $request->input('nombre');
        
        $tipos->save();

        return response()->json([
          "data" => $tipos -> toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tipo_id)
    {
        $tipos= Tipo::find($tipo_id);
        if($tipos == null){
            return response()->json([
                'message' => 'El tipo de pokemon no existe'
            ], 404);
        }

        $authUser = Auth::user();
        // usuario autenticado y recurso
        if($authUser->cant('view',$tipos )){
            return response()->json([
                "message" => 'El usuarion no esta autorizado para esta accion, '
            ], 403);
        }

        return $tipos->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tipo_id)
    {
        $tipos= Tipo::find($tipo_id);

        if($tipos == null){
            return response()->json([
                'message' => 'El tipo de pokemon no existe'
            ], 404);
        }
        
        $validator = TipoUpdateValidator::createValidator($request, $tipo_id);
        if($validator->fails()){
            return response()->json([
                'message' => ' Error de validacion',
                'errors' => $validator->errors()
            ]);
        }
        
        if($request->exists("nombre")){
            $tipos->nombre = $request->input('nombre');
        }
        $tipos->save();
        //
        return response()->json([
            'data'=> $tipos->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipo_id)
    {
        $tipos= Tipo::find($tipo_id);
        if($tipos == null){
            return response()->json([
                'message' => 'El pokemon no existe'
            ], 404);
        }
        $tipos->delete();

        return response()->json(null, 204);
    }
}
