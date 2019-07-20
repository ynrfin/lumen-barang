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

$router->get('/', ['uses' => 'BarangController@showAll']);

$router->get('/{id}', [ 'uses' => 'BarangController@showOne' ]);

$router->patch('/{id}', [ 'uses' => 'BarangController@update' ]);

$router->delete('/{id}', [ 'uses' => 'BarangController@delete' ]);

//ambil barang, kurangi stok
$router->post('/{id}/decrease-stock', [ 'uses' => 'BarangController@decreaseStock' ]);

//tambah stok barang
$router->post('/{id}/increase-stock', [ 'uses' => 'BarangController@increaseStock' ]);


