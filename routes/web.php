<?php

//agar yang hanya bisa login yang bisa membuat CRUD quote
//tetapi untuk function index & show dapat melihat saja
Route::group(['middleware' => 'auth'], function(){
  Route::resource('quotes', 'QuoteController', ['except' => ['index', 'show']]);
  Route::post('comments/{id}', 'QuoteCommentCont@store');
  Route::get('/dashboard', 'HomeController@index')->name('home');
});


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'QuoteController@home');


Auth::routes();

//membuat route pada localhost/quotes yang menampilkan function index dan show

Route::get('quotes/random', 'QuoteController@random');
Route::resource('quotes', 'QuoteController', ['only' => ['index', 'show']]);

//? artinya id itu optional
Route::get('profile/{id?}', 'HomeController@profile');
