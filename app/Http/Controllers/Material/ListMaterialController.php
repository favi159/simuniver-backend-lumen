<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class ListMaterialController extends Controller
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

    public function show()
    {
        $query = Material::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Material::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Material::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showByStateStep(Request $request)
    { 
        $state = State::where('paso', $request->input('paso'))->first();       
        if ($state != null) {
            $query = Material::where('state_id', $state->id)->with('getCondition:id,nombre,color', 'getType:id,nombre', 'getUser:id,username', 'getCareers:nombre', 'getCategories:nombre')->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function showByNameAndStateStep(Request $request)
    { 
        $state = State::where('paso', $request->input('paso'))->first();       
        if ($state != null) {
            $query = Material::where('state_id', $state->id)->where('nombre', 'like', '%'.$request->input('nombre').'%')->with('getCondition:id,nombre,color', 'getType:id,nombre', 'getUser:id,username', 'getCareers:nombre', 'getCategories:nombre')->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function showByCategoryAndStateStep(Request $request)
    { 
        $state = State::where('paso', $request->input('paso'))->first();       
        if ($state != null) {
            $query = Material::join('material_category', 'material_category.material_id', '=', 'material.id')
                                ->join('category', 'category.id', '=', 'material_category.category_id')
                                ->where('category.id', $request->input('category_id'))
                                ->where('material.state_id', $state->id)
                                ->select('material.*')
                                ->with('material.getCondition:id,nombre,color', 'material.getType:id,nombre', 'material.getUser:id,username', 'material.getCareers:nombre', 'material.getCategories:nombre')
                                ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function showByCareerAndStateStep(Request $request)
    { 
        $state = State::where('paso', $request->input('paso'))->first();       
        if ($state != null) {
            $query = Material::join('material_career', 'material_career.material_id', '=', 'material.id')
                                ->join('career', 'career.id', '=', 'material_career.career_id')
                                ->where('career.id', $request->input('career_id'))
                                ->where('material.state_id', $state->id)
                                ->select('material.*')
                                ->with('material.getCondition:id,nombre,color', 'material.getType:id,nombre', 'material.getUser:id,username', 'material.getCareers:nombre', 'material.getCategories:nombre')
                                ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function showByFacultyAndStateStep(Request $request)
    { 
        $state = State::where('paso', $request->input('paso'))->first();       
        if ($state != null) {
            $query = Material::join('material_career', 'material_career.material_id', '=', 'material.id')
                                ->join('career', 'career.id', '=', 'material_career.career_id')
                                ->where('career.faculty_id', $request->input('faculty_id'))
                                ->where('material.state_id', $state->id)
                                ->select('material.*')
                                ->with('material.getCondition:id,nombre,color', 'material.getType:id,nombre', 'material.getUser:id,username', 'material.getCareers:nombre', 'material.getCategories:nombre')
                                ->get();
            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

}
