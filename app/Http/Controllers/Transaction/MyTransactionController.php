<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class MyTransactionController extends Controller
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
        $query = Transaction::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $query = Transaction::where('id' ,$request->input('transaction_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Transaction::where('id' ,$request->input('transaction_id'))->first();

        return response()->json(['status' => 'success']);
    }  
    
    public function concluir(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        $query = Transaction::join('material', 'order.material_id', '=', 'material.id')
                                ->where('transaction.id' ,$request->input('transaction_id'))
                                ->where('material.user_id' , $user->id)
                                ->first(); //solicitud que se quiere aceptar

        if ($order) {                

            if ($order->concluida) {
                return response()->json(['status' => 'esta transaccion ya está concluida'],401);
            } else {
                $query->fill([
                    'concluida' => 1
                ], $request->input('transaction_id'));
    
                $query->save();
    
                return response()->json(['status' => 'success']);                 
            }
            
            
        } else {
            return response()->json(['status' => 'esta transaccion no pertenece al usuario logeado'],401);
        }
    }  
}
