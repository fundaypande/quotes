<?php

//agar yang hanya bisa login yang bisa membuat CRUD quote
//tetapi untuk function index & show dapat melihat saja
Route::group(['middleware' => ['auth','userApprove']], function(){

  Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin', 'AdminController@index');
    Route::put('/admin/approve/{id}', 'AdminController@update');
  });

  Route::resource('quotes', 'QuoteController', ['except' => ['index', 'show']]);
  Route::put('comments/{id}', 'QuoteCommentCont@update');
  Route::delete('comments/{id}', 'QuoteCommentCont@destroy');
  Route::post('comments/{id}', 'QuoteCommentCont@store');
  Route::get('comments/{id}/edit', 'QuoteCommentCont@edit');

  Route::get('/dashboard', 'HomeController@index')->name('home');

});




// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'QuoteController@home');
Route::get('/post', function(){
  return view('main.post');
});


Auth::routes();

//membuat route pada localhost/quotes yang menampilkan function index dan show

Route::get('quotes/random', 'QuoteController@random');
Route::resource('quotes', 'QuoteController', ['only' => ['index', 'show']]);

//? artinya id itu optional
Route::get('profile/{id?}', 'HomeController@profile');
