<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class ListTransactionController extends Controller
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
        $query = Transaction::all();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showOnlyTrashed()
    {
        $query = Transaction::onlyTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function showAll()
    {
        $query = Transaction::withTrashed()->get();

        return response()->json(['status' => 'success', 'data' => $query]);
    }

}
