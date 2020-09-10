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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//category routes
Route::get('/create-category', 'CategoryController@create')->name('create-category');
Route::resource('categories','CategoryController');

//book routes
Route::put('book/{id}', 'BookController@updateStatus');
Route::get('/create-book', 'BookController@create')->name('create-book');
Route::resource('books','BookController');

Route::get('dataTableBooks', 'BookController@dataTable')->name('dataTableBook');

Auth::routes();

