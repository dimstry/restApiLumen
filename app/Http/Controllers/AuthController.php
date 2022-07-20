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
            'password' => $password
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
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if(Hash::check($password, $user->password))
        {
            $apiToken = base64_encode(Str::random(40));

            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'success' => true,
                'massage' => 'Login success',
                'data' => [
                    'user' => $user,
                    'api token' => $apiToken
                ]
            ], 201);
        }else {
            return response()->json([
                'success' => false,
                'massage' => 'Login fail',
                'data' => ''
            ], 400);
        }
    }

}
