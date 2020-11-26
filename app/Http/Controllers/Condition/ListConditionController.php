<?php

namespace App\Http\Controllers\Condition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Condition;

class ListConditionController extends Controller
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
        $query = Condition::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Condition::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Condition::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
