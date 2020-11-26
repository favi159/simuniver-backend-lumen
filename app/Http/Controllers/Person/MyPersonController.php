<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Person;

class MyPersonController extends Controller
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
        'nickname',
        'nombres',
        'aPaterno',
        'aMaterno',
        'fecNacimiento',
        'email',
        'telefono',
        'celular',
        'career_id',
        'foto',
        'user_id'
    ];

    public function store(Request $request)
    {
        $query = Person::create($request->only($this->attributes));

        $query->save();

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if ($user->id == $request->input('user_id')) {
            $query = Person::where('user_id' ,$user->id)->first();
            
            $query->fill($request->only($this->attributes), $query->id);

            $query->save();

            return response()->json(['status' => 'success', 'data' => $query]);
        } else {
            return response()->json(['status' => 'no se puede actualizar data que no pertenece al usuario logeado']);
        }
    }

    public function one(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'))->whereNotNull('api_token')->first();

        if ($user->id == $request->input('user_id')) {
            $query = Person::where('user_id' , $user->id)->with('getCareer:id,nombre')->first();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'no se puede visualizar data que no pertenece al usuario logeado']);
        }        
    }   
}
