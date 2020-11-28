<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
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
        'paso'
    ];

    public function store(Request $request)
    {
        $query = State::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = State::where('id' ,$request->input('state_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('state_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = State::where('id' ,$request->input('state_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = State::where('id' ,$request->input('state_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
