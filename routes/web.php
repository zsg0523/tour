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
	if (app()->environment('production')) {
		// 线上官网主页
		Route::redirect('/', 'https://www.wennoanimal.com/web/');
	} else {
		Route::redirect('/', '/products')->name('root');
		Route::get('products', 'ProductsController@index')->name('products.index');		
		Route::get('products/{shopProduct}', 'ProductsController@show')->name('products.show');
	}
	Route::redirect('/ios', 'https://apps.apple.com/hk/app/wenno/id1071091237?l=en');
	Route::redirect('/apk', 'https://play.google.com/store/apps/details?id=com.wennoanimal.wenno');
	Route::redirect('/appAndroid', 'https://www.wennoanimal.com/uploads/download/Wenno.apk');
	Route::redirect('/en/app', 'https://www.wennoanimal.com/web/#/features');
	
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


// contact us 邮件模版测试
Route::get('mailable', function () {
    return new App\Mail\ContactUs('Eden', 'shenggen93@163.com', '邮件模版测试');
});



Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function() {
	Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index'); //收货地址列表
	Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create'); //新建收货地址
	Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store'); // 保存收货地址
	Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit'); //编辑地址
	Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update'); 
 	Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');
 	Route::post('products/{shopProduct}/favorite', 'ProductsController@favor')->name('products.favor'); // 用户收藏
    Route::delete('products/{shopProduct}/favorite', 'ProductsController@disfavor')->name('products.disfavor'); // 取消收藏
});









