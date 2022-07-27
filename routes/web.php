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

// Users
$router->group(['prefix' => 'users'], function() use ($router) {
    $router->get('/', 'UserController@index');
    $router->post('/', 'UserController@store');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});

// Roles CTRLS
$router->group(['prefix' => 'rolectrls'], function() use ($router) {
    //$router->get('/', 'RolesCTRLSControllers@index');
    $router->post('/', 'RolesCTRLSControllers@store');
    //$router->get('/{id}', 'RolesCTRLSControllers@show');
    //$router->put('/{id}', 'RolesCTRLSControllers@update');
    $router->delete('/{id}', 'RolesCTRLSControllers@destroy');
});

// User Roles
$router->group(['prefix' => 'userroles'], function() use ($router) {
   // $router->get('/', 'UsersRolesControllers@index');
    $router->post('/', 'UsersRolesControllers@store');
   // $router->get('/{id}', 'UsersRolesControllers@show');
   // $router->put('/{id}', 'UsersRolesControllers@update');
    $router->delete('/{id}', 'UsersRolesControllers@destroy');
});

// Roles
$router->group(['prefix' => 'roles'], function() use ($router) {
    $router->get('/', 'RolesController@index');
    $router->post('/', 'RolesController@store');
   $router->get('/{id}', 'RolesController@show');
    $router->put('/{id}', 'RolesController@update');
    $router->delete('/{id}', 'RolesController@destroy');
});


// Roles
$router->group(['prefix' => 'ctrls'], function() use ($router) {
    $router->get('/', 'CTRLSController@index');
    $router->post('/', 'CTRLSController@store');
    $router->get('/{id}', 'CTRLSController@show');
    $router->put('/{id}', 'CTRLSController@update');
    $router->delete('/{id}', 'CTRLSController@destroy');
});


// auth
$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('/login', 'AuthController@login');
});

//general
$router->group(['prefix' => 'general'], function() use ($router) {
    $router->get('/ram', function() {
        return json_encode([
            'data' => 'TEXT from RAM SERVER'
        ]);
    });

    $router->get('/password', function() {
        return json_encode([
           'pass1 from server',
           'pass2 from server',
           'pass3 from server',
           'pass4 from server',
           'pass5 from server',
        ]);
    });
});
