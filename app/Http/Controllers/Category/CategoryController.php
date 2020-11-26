<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
        'descripcion'
    ];

    public function store(Request $request)
    {
        $query = Category::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = Category::where('id' ,$request->input('category_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('category_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = Category::where('id' ,$request->input('category_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function one(Request $request)
    {
        $query = Category::where('id' ,$request->input('category_id'))->first();

        return response()->json(['status' => 'success']);
    }   
}
