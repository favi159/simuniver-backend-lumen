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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('login/','AuthenticateController@authenticate');
    
    $router->group(['middleware' => 'auth'], function() use ($router) {
        $router->post('show/','UserController@show');
        $router->post('showAll/','UserController@showAll');
        $router->post('showOnlyTrashed/','UserController@showOnlyTrashed');
        $router->post('store/','UserController@store');
        $router->post('delete/','UserController@delete');
        $router->post('update/','UserController@update');
    });
});
