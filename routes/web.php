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
Route::get('/user-panel','FrontendController@userPanel');

Route::resources(['users'=>'UserController']);

Route::post('/testvalidation','TestController@testvalidation');