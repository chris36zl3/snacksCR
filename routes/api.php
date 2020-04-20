<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




 //USER
Route::group(['prefix' => 'v1'], function ($router) {

    Route::resource('v1', 'UserController');


    //Route::post('register','UserController@register');
    Route::post('register', 'UserController@register')->name('register');

    //Route::post('login', 'UserController@login');
    Route::post('login', 'UserController@login')->name('login');

    Route::get('profile', 'UserController@getAuthenticatedUser')->name('profile');



    Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
    });


});

  //PRODUCTO
  Route::post('registrarProducto', 'ProductoController@registrarProducto')->name('add.product');

  //Venta
  Route::get('/ventas', 'VentaController@index');
  Route::post('create', 'VentaController@create')->name('view.venta');
  Route::resource('producto', 'ProductoController');
  Route::post('crearVenta', 'VentaController@crearVenta')->name('add.venta');


  Route::post('terminarVenta', 'VentaController@terminarVenta')->name('end.venta');
