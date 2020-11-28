<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class ListMyTransactionController extends Controller
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

    public function show(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Transaction::where('user_id', $token->id)->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else {
            return response()->json(['status' => 'fail'],401);
        }
    }

    public function showForMyMaterials()
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if($user){
            $query = Transaction::join('material', 'transaction.material_id', '=', 'material.id')
                                    ->where('material.user_id' , $user->id)
                                    ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        }else {
            return response()->json(['status' => 'fail'],401);
        }
    }

}
