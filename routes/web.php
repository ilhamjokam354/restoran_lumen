<?php

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

$router->get('/key', 'ExampleController@key');

// $router->get('/menu', [
//     'uses' => 'MenuController@index',
//     'as' => 'list_menu'
// ]);

$router->post('/login', 'AuthController@postLogin');
$router->post('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@register');
$router->post('/register_pelanggan', 'AuthController@registerPelanggan');

$router->post('/login_pelanggan', 'AuthController@loginPelanggan');
// $router->group(['middleware' => 'assign.guard'],function ($router)
// {
	
// });

$router->get('/pelanggan/menu', 'MenuController@index');
$router->get('/pelanggan/kategori', 'KategoriController@index');
$router->group(['prefix' => 'pelanggan', 'middleware' => 'auth:api'],  function($router){

    
    
    $router->get('/menu'.'/{id}', 'MenuController@show');
    $router->post('/menu', 'MenuController@store');
    $router->get('/order', 'OrderController@index');
    $router->post('/order', 'OrderController@store');
    $router->get('/pelanggan', 'PelangganController@index');
});
// function kategori($router, $uri, $controller){
//     $router->get($uri, $controller.'@index');
//     $router->post($uri, $controller.'@store');

//     $router->get($uri.'/{id}', $controller.'@show');
//     $router->put($uri.'/{id}', $controller.'@update');
//     $router->patch($uri.'/{id}', $controller.'@update');

//     $router->delete($uri.'/{id}', $controller.'@destroy');

// }
// kategori($router, '/kategori', 'KategoriController');

// function menu($router, $uri, $controller){
    
// }
// menu($router, '/menu', 'MenuController');


// // function kategori($router, $uri, $controller){
// //     $router->get($uri.'/{id}', $controller.'@getKategori');
// //     $router->post($uri, $controller.'@postKategori');
// // }
// // kategori($router, '/kategori', 'TblKategori');

// function order($router, $uri, $controller){
    
// }
// order($router, '/order', 'OrderController');

// function user($router, $uri, $controller){
    

// }
// user($router, '/user', 'UserController');

// order($router, '/order', 'OrderController');

// function pelanggan($router, $uri, $controller){
    

// }
// pelanggan($router, '/pelanggan', 'PelangganController');

// function order_detail($router, $uri, $controller){
    

// }
// order_detail($router, '/order_detail', 'OrderDetailController');



$router->post('/user/banned'.'/{id}', 'UserController@userBanned');
$router->post('/user/aktif'.'/{id}', 'UserController@userAktif');
$router->get('/menu/kategori'.'/{id_kategori}', 'MenuController@showKategori');

//Middleware
$router->group(['middleware' => 'auth:api'], function($router){


    //VIEW
    $router->get('/vorder', 'VorderController@vorder');
    $router->get('/vorderdetail', 'VorderController@vorderdetail');
    $router->get('/vorder'.'/{id}', 'VorderController@show');
    $router->get('/search/vorder'.'/{keyword}', 'VorderController@search');
    $router->get('/search/vorderdetail'.'/{keyword}', 'VorderController@searchOrderDetail');
    $router->get('/search/vorderdetail/tgl_order'.'/{tgl_awal}'.'/{tgl_akhir}', 'VorderController@searchTglOrder');
    
    //KATEGORI
    $router->get('/kategori', 'KategoriController@index');
    $router->post('/kategori', 'KategoriController@store');
    $router->get('/kategori'.'/{id}', 'KategoriController@show');
    $router->put('/kategori'.'/{id}', 'KategoriController@update');
    $router->patch('/kategori'.'/{id}', 'KategoriController@update');
    $router->delete('/kategori'.'/{id}', 'KategoriController@destroy');

    //ORDER DETAIL
    $router->get('/order_detail', 'OrderDetailController@index');
    $router->post('/order_detail', 'OrderDetailController@store');
    $router->get('/order_detail'.'/{id}', 'OrderDetailController@show');
    $router->put('/order_detail'.'/{id}', 'OrderDetailController@update');
    $router->patch('/order_detail'.'/{id}', 'OrderDetailController@update');
    $router->delete('/order_detail'.'/{id}', 'OrderDetailController@destroy');

    //PELANGGAN
    $router->get('/pelanggan', 'PelangganController@index');
    $router->post('/pelanggan', 'PelangganController@store');
    $router->get('/pelanggan'.'/{id}', 'PelangganController@show');
    $router->put('/pelanggan'.'/{id}', 'PelangganController@update');
    $router->patch('/pelanggan'.'/{id}', 'PelangganController@update');
    $router->delete('/pelanggan'.'/{id}', 'PelangganController@destroy');

    //USER
    $router->get('/user', 'UserController@index');
    $router->post('/user', 'UserController@store');
    
    $router->get('/user'.'/{id}', 'UserController@show');
    $router->put('/user'.'/{id}', 'UserController@update');
    $router->patch('/user'.'/{id}', 'UserController@update');
    $router->delete('/user'.'/{id}', 'UserController@destroy');

    //ORDER
    
    $router->get('/order', 'OrderController@index');
    $router->post('/order', 'OrderController@store');
    $router->get('/order'.'/{id}', 'OrderController@show');
    $router->put('/order'.'/{id}', 'OrderController@update');
    $router->patch('/order'.'/{id}', 'OrderController@update');
    $router->delete('/order'.'/{id}', 'OrderController@destroy');

    //MENU
    $router->get('/menu', 'MenuController@index');
    $router->post('/menu', 'MenuController@store');
    $router->get('/menu'.'/{id}', 'MenuController@show');
    
    $router->post('/menu'.'/{id}', 'MenuController@update');
    $router->patch('/menu'.'/{id}', 'MenuController@update');
    $router->delete('/menu'.'/{id}', 'MenuController@destroy');
});
