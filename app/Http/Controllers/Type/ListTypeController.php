<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class ListTypeController extends Controller
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
        $query = Type::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Type::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Type::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
