<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
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

    public function update(Request $request)
    {
        $query = Order::where('id' ,$request->input('order_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('order_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
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
}
