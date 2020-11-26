<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Career;

class CareerController extends Controller
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
        'faculty_id'
    ];

    public function store(Request $request)
    {
        $query = Career::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Career::where('id' ,$request->input('career_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('career_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Career::where('id' ,$request->input('career_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Career::where('id' ,$request->input('career_id'))->with('getFaculty:id,nombre')->first();

        return response()->json(['status' => 'success']);
    }   
}
