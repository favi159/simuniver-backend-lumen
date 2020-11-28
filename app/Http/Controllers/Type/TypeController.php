<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
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
        'nombre'
    ];

    public function store(Request $request)
    {
        $query = Type::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Type::where('id' ,$request->input('type_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('type_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Type::where('id' ,$request->input('type_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Type::where('id' ,$request->input('type_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
