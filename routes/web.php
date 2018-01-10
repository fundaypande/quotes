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

Route::get('/home', 'HomeController@index')->name('home');

//membuat route pada localhost/quotes yang menampilkan function index dan show
Route::resource('quotes', 'QuoteController', ['only' => 'index', 'show']);

//agar yang hanya bisa login yang bisa membuat CRUD quote
//tetapi untuk function index & show dapat melihat saja
Route::group(['middleware' => 'auth'], function(){
  Route::resource('quotes', 'QuoteController', ['except' => 'index', 'show']);
});
