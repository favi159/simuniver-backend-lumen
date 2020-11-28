<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class MaterialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected $attributes = [
        'nombre',
        'descripcion',
        'precio',
        'foto',
        'tiempoReferencial',
        'user_id',
        'condition_id',
        'type_id',
        'getCareers',
        'getCategories'
    ];

    public function store(Request $request)
    {
        $query = Material::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Material::where('id' ,$request->input('material_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('material_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Material::where('id' ,$request->input('material_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Material::where('id' ,$request->input('material_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
