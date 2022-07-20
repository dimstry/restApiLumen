<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // jalan kan middleware only get user
        //$this->middleware('age', ['only' => ['getUser']]);
        // jalan kan middleware ke semua kecuali getUser
        //$this->middleware('age', ['except' => ['getUser']]);
    }

    public function keyGenerate()
    {
        return Str::random(32);
    }

    public function postController()
    {
        return 'Testing Controller';
    }

    public function getUser($id)
    {
        return 'user id = '. $id;
    }

    public function Category($cat1,$cat2)
    {
        return 'Category 1 = ' . $cat1 . ' Category 2 =' . $cat2;
    }

    public function getProfile()
    {
        echo '<a href="'.route('profile.action') .'">Pofile Action</a>';
    }

    public function getProfileAction()
    {
        return 'Router Profile : ' . route('profile');
    }

    public function fooBar(Request $request)
    {
        // if($request->is('foo/bar'))
        // {
        //     return 'Success';
        // }else{
        //     return 'Fail';
        // }
        // melihat path / url nya
        //return $request->path();
        // Melihat Method
        return $request->method();
    }


    public function userProfile(Request $request)
    {
        // memasukan ke variabel
        // $user['name'] = $request->name;
        // $user['username'] = $request->username;
        // $user['email'] = $request->email;
        // $user['password'] = $request->password;

        // return $user;

        // Mengambil semua data langsung
        // return $request->all();
        // Memberi nilai defualt
        // return $request->input('name', 'Dimas');

        // Kondisi
        // if($request->has('name'))
        // {
        //     return 'Success';
        // }else{
        //     return 'Fail';
        // }
        return $request->only('name', 'email');

    }


}
