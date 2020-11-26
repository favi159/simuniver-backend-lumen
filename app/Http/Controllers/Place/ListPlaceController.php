<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Place;

class ListPlaceController extends Controller
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
        $query = Place::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Place::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Place::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
