<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class MyOrderController extends Controller
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
        'user_id',
        'material_id',
        'comentario'
    ];

    public function store(Request $request)
    {
        $query = Order::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $query = Order::where('id' ,$request->input('order_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Order::where('id' ,$request->input('order_id'))->first();

        return response()->json(['status' => 'success']);
    }  
    
    public function accept(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        $order = Order::join('material', 'order.material_id', '=', 'material.id')
                                ->where('order.id' ,$request->input('order_id'))
                                ->where('material.user_id' , $user->id)
                                ->first(); //solicitud que se quiere aceptar

        if ($order) {                

            if ($order->aceptada) {
                return response()->json(['status' => 'esta solicitud ya está aceptada'],401);
            } else {
                $order->fill([
                    'aceptada' => $aceptada
                ], $request->input('order_id'));
    
                $order->save();
    
                return response()->json(['status' => 'success']);                 
            }
            
            
        } else {
            return response()->json(['status' => 'esta solicitud no pertenece al usuario logeado'],401);
        }
    }  
}
