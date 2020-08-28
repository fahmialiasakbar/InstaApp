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

Route::get('/','PostController@index');
Route::get('/home','PostController@index');
Route::get('/posts','PostController@index');
Route::get('/detail/{id}', 'PostController@detail');
Route::get('/newpost','PostController@new');
Route::post('/post/insert', 'PostController@insert');

Route::post('/like', 'PostController@like');
Route::post('/unlike', 'PostController@unlike');
Route::post('/comment', 'PostController@comment');

Route::get('/myprofile', 'ProfileController@index');
Route::get('/profile/{id}', 'ProfileController@profile');