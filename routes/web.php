<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('products', 'ProductsController');

Route::resource('in_shooping_carts','InShoppingCartsController',['only'=>['store','destroy']]);

Route::get('/carrito', 'ShoppingCartsController@index');

Route::post('/carrito', 'ShoppingCartsController@checkout');

Route::get('/payments/store','PaymentsController@store');

Route::resource('/compras','ShoppingCartsController', ['only' => ['show']]);

Route::resource('orders', 'OrdersController', ['only' => ['index','update']]);

Route::get('products/images/{filename}', function($filename){
  $path = storage_path("app/images/$filename");


  $file = \File::get($path);
  $type = \File::mimeType($path);
  $response = Response::make($file,200);
  $response->header("Content-Type", $type);

  return $response;
});
