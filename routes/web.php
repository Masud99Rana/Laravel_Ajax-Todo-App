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


// ajax bro
// See http://prntscr.com/nqr4ie
Route::resource('post','PostController');
Route::POST('addPost','PostController@addPost');
Route::POST('editPost','PostController@editPost');
Route::POST('deletePost','PostController@deletePost');


// Todo App
// See http://prntscr.com/nqr748
Route::get('list', 'ListController@index');
Route::post('list', 'ListController@create');
Route::post('delete', 'ListController@delete');
Route::post('update', 'ListController@update');
//auto complete
Route::get('search', 'ListController@search');