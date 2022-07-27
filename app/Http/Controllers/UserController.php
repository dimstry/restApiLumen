<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Date;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function datas(Request $request)
    {
        $tokenApi = explode(' ',$request->header('Authorization'));
        $decoded = JWT::decode($tokenApi[1], new Key(env('JWT_KEY'), 'HS256'));
        // var_dump($decoded);
        // exp time
        // $exp = '1658716555';
        $exp = $decoded->exp;
        $now = time(); 
        // var_dump('jam exp '.$exp);
        // var_dump('jam sekarang '.$now);  
        if ($exp < $now) {
            return 'token kadaluarsa';
        }else{
            $id = $decoded->uid;
            $user = User::find($id); 
            if($user)
            {
                return response()->json([
                    'success' => true,
                    'massage' => 'User Found',
                    'data' => $user
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'massage' => 'User Not Found',
                    'data' => ''
                ], 404);
            }
        }
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
