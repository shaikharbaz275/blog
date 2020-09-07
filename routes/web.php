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

Route::get('/','PageController@index');
Route::get('/category/{id}','PageController@categoryIndex');
Route::get('/view/{post}','PageController@viewPost');



Auth::routes();




//Admin routes
Route::middleware('auth')->group(function () {

Route::get('/home', 'HomeController@index')->name('home');

//post route   
Route::resource('posts','PostController');

Route::resource('categories','CategoryController');

//post remove image
Route::delete('/post/{post}/remove-image', 'PostController@imageDelete')->name('post.remove-image');

});






