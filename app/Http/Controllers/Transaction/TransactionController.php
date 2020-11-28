<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
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
        'fecInicio',
        'fecFin',
        'place_id'
    ];

    public function store(Request $request)
    {
        $query = Transaction::create($request->only($this->attributes));

        //por defecto todas las transacciones no están concluídas al registrarse.
        
        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Transaction::where('id' ,$request->input('transaction_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('transaction_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
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
}
