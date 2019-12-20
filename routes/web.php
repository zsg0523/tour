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


Route::group(['middleware' => ['setLocale']], function() {

	Route::redirect('/', 'https://www.wennoanimal.com/web/');
	Route::redirect('/ios', 'https://apps.apple.com/hk/app/wenno/id1071091237?l=en');
	Route::redirect('/apk', 'https://play.google.com/store/apps/details?id=com.wennoanimal.wenno');
	Route::redirect('/en/app', 'https://www.wennoanimal.com/uploads/download/Wenno.apk');
	
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
	Route::get('result', function () {
	    return view('result.index');
	});

	Route::get('downloadpdf', 'SetLocaleController@downloadpdf');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// contact us 邮件模版测试
Route::get('mailable', function () {
    return new App\Mail\ContactUs('Eden', 'shenggen93@163.com', '打算大的撒放水淀粉');
});


