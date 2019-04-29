<?php
use Illuminate\Http\Request;

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

$router->get('/login', function (Request $request) {
    $token = app('auth')->attempt($request->only('email', 'password'));
 
    return response()->json(compact('token'));
});

$router->group(['prefix' => 'auth'], function () use($router) {
    $router->post('login', 'AuthController@login');    
});

$router->group([
    'middleware' => 'auth',
    'prefix' => 'auth',
], function () use($router) {
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');

});