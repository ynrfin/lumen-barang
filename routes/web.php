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

$router->get('/', ['as' => 'barang.all', 'uses' => 'BarangController@showAll']);

$router->get('/{id}', ['as'=>'barang.one', 'uses' => 'BarangController@showOne' ]);

$router->post('/', ['as'=>'barang.create','uses' => 'BarangController@create']);

$router->patch('/{id}', ['as'=>'barang.patch', 'uses' => 'BarangController@patch' ]);

$router->put('/{id}', ['as'=>'barang.put', 'uses' => 'BarangController@put' ]);

$router->delete('/{id}', ['as'=>'barang.delete', 'uses' => 'BarangController@delete' ]);

$router->group(['prefix' => 'category'], function () use ($router){
    $router->get('/{id}', ['as' => 'category.showOne', 'uses' => 'CategoryController@showOne']);

    //$router->get('/', ['as' => 'category.showAll', 'uses' => 'CategoryController@showAll']);

});

