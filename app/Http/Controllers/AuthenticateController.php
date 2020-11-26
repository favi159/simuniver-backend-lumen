<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;

class AuthenticateController extends Controller
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

    public function authenticate(Request $request) 
    {
        $user = User::where('username', $request->input('username'))->first();

        if ($request->input('password') == $user->password) {
            $apikey = base64_encode(Str::random(40));
            User::where('username', $request->input('username'))->update(['api_token' => $apikey]);

            return response()->json(['status' => 'success','api_token' => $apikey]);
        } else {
            return response()->json(['status' => 'fail'],401);
        }
    }
}
