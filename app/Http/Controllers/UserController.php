<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function datas(Request $request)
    {
        $tokenApi = explode(' ',$request->header('Authorization'));
        // var_dump($tokenApi[1]);
        $decoded = JWT::decode($tokenApi[1], new Key(env('JWT_KEY'), 'HS256'));
        var_dump($decoded);

    }

    public function show($id)
    {
        $user = User::find($id); 
        if($user){
            return response()->json([
                'success' => true,
                'massage' => 'User Found',
                'data' => $user
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'massage' => 'User Not Found',
                'data' => ''
            ], 404);
        }  
    }

}
