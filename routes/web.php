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

// User routes
//$router->get('/users', ['uses' => 'UserController@getUsers']);
$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@add');
$router->get('/users/{id}', 'UserController@show');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');

// Library routes
$router->get('/libraries', 'LibraryController@index');
$router->get('/libraries/{id}', 'LibraryController@show');
$router->post('/libraries', 'LibraryController@add');
$router->put('/libraries/{id}', 'LibraryController@update');
$router->delete('/libraries/{id}', 'LibraryController@delete');

// Review routes
$router->get('/reviews', 'ReviewController@index');
$router->get('/reviews/{id}', 'ReviewController@show');
$router->post('/reviews', 'ReviewController@add');
$router->put('/reviews/{id}', 'ReviewController@update');
$router->delete('/reviews/{id}', 'ReviewController@delete');