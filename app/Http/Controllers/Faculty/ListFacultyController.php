<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faculty;

class ListFacultyController extends Controller
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
        $query = Faculty::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Faculty::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Faculty::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
