<?php

use Illuminate\Support\Facades\Route;
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



Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('report', 'ReportController');

    Route::get('/products', 'ProductsController@index')->name('product.all');
    Route::post('/products/add', 'ProductsController@store')->name('product.add');
    Route::post('/products/update', 'ProductsController@update')->name('product.update');
});
