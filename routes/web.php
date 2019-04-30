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


/*
|--------------------------------------------------------------------------
| JWT AUTH ROUTES
|--------------------------------------------------------------------------
|
| Here is where routes for JWT auth placed
|
*/
$router->group(['prefix' => 'api/v2'], function () use($router) {
    $router->post('login', 'AuthJwtController@login');    
});
$router->group([
    'middleware' => 'auth_jwt_middleware:api_jwt',
    'prefix' => 'api/v2',
], function () use($router) {
    $router->post('logout', 'AuthJwtController@logout');
    $router->post('refresh', 'AuthJwtController@refresh');
    $router->post('me', 'AuthJwtController@me');
});



/*
|--------------------------------------------------------------------------
| API KEY AUTH ROUTES
|--------------------------------------------------------------------------
|
| Here is where routes for API KEY auth placed
|
*/
$router->group([
    'middleware' => 'auth_middleware:api',
    'prefix' => 'api/v1',
], function () use($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});