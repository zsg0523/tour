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


/** 多语言切换 */
Route::get('/setLocale/{locale}', 'SetLocaleController@setLocale');


Route::group(['middleware' => ['setLocale']], function() {
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('books', function () {
	    return view('books.book');
	});

	Route::get('animals', function () {
	    return view('animals.index');
	});

	Route::get('animals/database', function () {
	    return view('animals.database');
	});

	Route::get('animals/chooseLanguage', function () {
	    return view('animals.chooseLanguage');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

