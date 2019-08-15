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

Route::view('/', 'welcome');

Auth::routes(['register']);

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/lang', 'LangController')->name('lang');

// pages routes...
Route::resource('pages', 'PageController');

Route::view('/contact-us', 'pages.contact')->name('contact');