<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipo::all();
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
        //dd($request->input('nombre'));
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
        
        $tipos->nombre = $request->input('nombre');
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
