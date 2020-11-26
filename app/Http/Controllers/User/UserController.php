<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        'username',
        'password'
    ];

    public function store(Request $request)
    {
        $query = User::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $query = User::where('id' ,$request->input('user_id'))->first();
            
        $query->fill($request->only($this->attributes), $request->input('user_id'));

        $query->save();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function delete(Request $request)
    {
        $query = User::where('id' ,$request->input('user_id'))->first();

        $query->delete();

        return response()->json(['status' => 'success']);
    }

    public function show()
    {
        $query = User::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = User::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = User::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }
}
