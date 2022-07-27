<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Firebase\JWT\JWT;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required'
        ]);

        $id         = bin2hex(random_bytes(4)) . "-" . bin2hex(random_bytes(4)) . "-" . date('YmdHisms');
        $name       = $validated['username'];
        $email      = $validated['email'];
        $password   = Hash::make($validated['password']);
        
        $register = User::create([
            'id'        => $id,
            'username'  => $name,
            'email'     => $email,
            'password'  => $password
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'massage' => 'Register Success',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Register Fail!!',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $validated = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $validated['email'];
        $password = $validated['password'];

        $user = User::where('email', $email)->first();
        var_dump($user);

        if (Hash::check($password, $user->password)) {
            $payload = [
                'iat' => intval(microtime(true)),
                'exp' => intval(microtime(true)) + (60 * 60 * 1000),
                'allowed_role' => 'user',
                'uid' => $user['id']
            ];

            $apiToken = JWT::encode($payload, env('JWT_KEY'), 'HS256');
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
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Login fail',
                'data' => ''
            ], 400);
        }
    }
}
