<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
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
        $query = Faculty::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Faculty::where('id' ,$request->input('faculty_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('faculty_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Faculty::where('id' ,$request->input('faculty_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Faculty::where('id' ,$request->input('faculty_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
