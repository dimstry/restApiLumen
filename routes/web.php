<?php

/** @var \Laravel\Lumen\Routing\Router $router */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Key genarate 
$router->get('/key', 'ExampleController@keyGenerate');

$router->post('/foo', 'ExampleController@postController');



$router->get('/user/{id}', 'ExampleController@getUser');
$router->get('/pos/cat1/{cat1}/cat2/{cat2}', 'ExampleController@Category');

$router->get('/profile', ['as' => 'profile' , 'uses' => 'ExampleController@getProfile']);
$router->get('/profile/action', ['as' => 'profile.action', 'uses' => 'ExampleController@getProfileAction']);




$router->get('admin/home', ['middleware' => 'age', function () {
    return 'Old enough';
}]);

$router->get('/foo/bar', 'ExampleController@fooBar');
$router->post('/bar/foo', 'ExampleController@fooBar');


$router->get('fail', function () {
    return 'Not yet mature';
});