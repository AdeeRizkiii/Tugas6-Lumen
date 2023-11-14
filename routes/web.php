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

$router->get('/hello-lumen', function () {
    return "<h1>Lumen</h1><p>Hello good developer! thanks for using lumen.</p>";
});

$router->get('/hello-lumen/{name}', function ($name){
    return "<h1>Lumen</h1><p>hi<b>" . $name . "</b>thanks for using lumen</p>";
});

$router->get('/tugas', ['middleware' => 'login', function(){
    return "<h1>Hallo Jumpa Lagi kita</h1>";
}]);

$router->get ('/users', 'UsersController@index');


//post
$router->get('/posts', 'PostsController@index');
$router->post('/posts', 'PostsController@store');
$router->get('/post/{id}', 'PostsController@show');
$router->put('/post/{id}', 'PostsController@update');
$router->delete('/post/{id}', 'PostsController@destroy');

//Users
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
});


//

/*Tugas 4 
$router->get('User', 'UserController@index');
$router->post('User', 'UserController@store');
*/

/*tugas routing
$router->get('/welcome', function () {
    return "<h1>Selamat Datang di Web</h1><p>Mari belajar Lumen.</p>";
});

$router->get('/welcome/{name}', function ($name) {
    return "<h1>Selamat Datang $name</h1><p>Mari belajar Lumen.</p>";
});

$router->get('/hallo/{name}', function ($name) {
    return "<h1>HAllO!!  $name</h1><p>Kita akan memulai pembelajaran</p>";
});

$router->get('/start/{name}', function ($name) {
    return "<h1>Get Started  $name</h1><p>Mari Kita MUlai</p>";
});

//tugas Controller
$router->get ('/latihan', 'UsersController@latihan');
*/


