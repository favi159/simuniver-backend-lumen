<?php

namespace App\Http\Controllers\Condition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Condition;

class ConditionController extends Controller
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
        'color',
        'orden'
    ];

    public function store(Request $request)
    {
        $query = Condition::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Condition::where('id' ,$request->input('condition_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('condition_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Condition::where('id' ,$request->input('condition_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Condition::where('id' ,$request->input('condition_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
