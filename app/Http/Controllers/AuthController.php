<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $api = Str::random(10);
        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'api_token' => $api
        ]);

        if($register)
        {
            return response()->json([
                'success' => true,
                'massage' => 'Register Success',
                'data' => $register
            ], 201);
        }else{            
            return response()->json([
                'success' => false,
                'massage' => 'Register Fail!!',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request)
    {

    }

}
