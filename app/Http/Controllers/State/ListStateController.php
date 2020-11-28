<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;

class ListStateController extends Controller
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
        $query = State::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = State::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = State::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
