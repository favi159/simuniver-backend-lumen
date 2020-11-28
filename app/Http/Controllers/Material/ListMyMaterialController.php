<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class ListMyMaterialController extends Controller
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

    public function show()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Material::where('user_id', $user->id)->with('getCondition:id,nombre,color', 'getType:id,nombre', 'getUser:id,username', 'getCareers:nombre', 'getCategories:nombre')->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

    public function showByStateStep()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $state = State::where('paso', $request->input('paso'))->first();
            $query = Material::where('user_id', $token->id)->where('state_id', $state->id)->with('getCondition:id,nombre,color', 'getType:id,nombre', 'getUser:id,username', 'getCareers:nombre', 'getCategories:nombre')->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

}
