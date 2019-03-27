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



/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index');

Route::resource('produto', 'ProdutoController');
Route::get('produto/{id}/desativar', 'ProdutoController@desativar');

Route::resource('recebimento', 'RecebimentoController');
Route::get('recebimento/{id}/desativar', 'RecebimentoController@desativar');

Route::resource('venda', 'VendaController');
Route::get('venda/{id}/desativar', 'VendaController@desativar');
