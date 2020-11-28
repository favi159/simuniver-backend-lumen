<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class ListOrderController extends Controller
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
        $query = Order::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Order::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Order::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
