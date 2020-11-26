<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
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
        'nickname',
        'nombres',
        'aPaterno',
        'aMaterno',
        'fecNacimiento',
        'email',
        'telefono',
        'celular',
        'career_id',
        'foto',
        'user_id'
    ];

    public function store(Request $request)
    {
        $query = Person::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Person::where('id' ,$request->input('person_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('person_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Person::where('id' ,$request->input('person_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Person::where('id' ,$request->input('person_id'))->with('getCareer:id,nombre')->first();

        return response()->json(['status' => 'success']);
    }   
}
