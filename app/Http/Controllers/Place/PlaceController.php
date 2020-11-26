<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Place;

class PlaceController extends Controller
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
        'descripcion',
        'foto'
    ];

    public function store(Request $request)
    {
        $query = Place::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Place::where('id' ,$request->input('place_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('place_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Place::where('id' ,$request->input('place_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Place::where('id' ,$request->input('place_id'))->with('getFaculty:id,nombre')->first();

        return response()->json(['status' => 'success']);
    }   
}
