<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class ListMyOrderController extends Controller
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
            $query = Order::where('user_id' , $user->id)->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

    public function showForMyMaterials()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Order::join('material', 'order.material_id', '=', 'material.id')
                                ->where('material.user_id' , $user->id)
                                ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

    public function showByAccept()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Order::where('user_id' , $user->id)
                            ->where('aceptada' , $request->input('aceptada'))
                            ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

    public function showForMyMaterialsByAccept()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Order::join('material', 'order.material_id', '=', 'material.id')
                            ->where('material.user_id' , $user->id)
                            ->where('order.aceptada' , $request->input('aceptada'))
                            ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else{
            return response()->json(['status' => 'fail'], 401);
        }
        
    }

}
