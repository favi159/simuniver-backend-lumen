<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class MyMaterialController extends Controller
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
        'user_id', //el id del user se obtiene por el api_token
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
    
    public function enable(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        $query = Material::where('id' ,$request->input('material_id'))->where('user_id', $user->id)->first(); //material que se quiere habilitar

        if ($query != null) {                
            $state = State::where('id', $material->state_id)->first();
            //1: no disponible, 2: disponible
            if ($state->paso == 1) {
                $stateHabilitado = State::where('paso', 2)->first();
            } else {
                $stateHabilitado = State::where('paso', 1)->first();
            }
            
            $query->fill([
                'state_id' => $stateHabilitado->id
            ], $request->input('material_id'));

            $query->save();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'este material no pertenece al usuario logeado'],401);
        }

        return response()->json(['status' => 'success']);
    }  
}
