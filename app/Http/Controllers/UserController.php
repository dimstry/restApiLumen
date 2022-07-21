<?php

namespace App\Http\Controllers;
use App\Models\User;
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
