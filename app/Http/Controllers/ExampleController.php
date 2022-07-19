<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

class ExampleController extends Controller
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
}
