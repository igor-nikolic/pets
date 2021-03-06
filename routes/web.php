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

Route::get('/','FrontendController@home')->name('home');
Route::get('/about','FrontendController@about')->name('about');
Route::get('/contact','FrontendController@contact')->name('contact');

Route::get('/logout','UserController@logout');
Route::get('/activate/{hash}','UserController@activate');
Route::post('/login','UserController@login')->name('login');
Route::post('/register','UserController@register')->name('register');

Route::post('/vote','FrontendController@vote');
Route::post('/email','FrontendController@sendEmail');
Route::get('/user-panel','FrontendController@userPanel');
Route::get('/pets/search','PetController@search');

Route::resource('pets','PetController');

//Route::middleware(['admin'])->group(function () {
//
//});
Route::group([
    'prefix'     => 'admin',
    'middleware' => 'admin',
], function() {
    Route::get('logs','\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/user/search','UserController@search');
    Route::get('/breed/search','BreedController@search');
    Route::get('/home','AdminController@home')->name('admin-panel');
    Route::post('/users/reactivate/{userid}','UserController@reactivate');
    Route::resource('users','UserController');
    Route::resource('breeds','BreedController');
});