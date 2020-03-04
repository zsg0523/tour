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

Route::get('/user_info', function () { return view('user_info/index'); });
Route::get('/contact', function () { return view('user_info/contact'); });
Route::get('/aboutUs', function () { return view('user_info/aboutUs'); });


Auth::routes(['verify' => true]);
// 商城首页
Route::redirect('/shop', '/products')->name('root');
// 产品页
Route::get('products', 'ProductsController@index')->name('products.index');

Route::group(['middleware' => ['auth', 'verified']], function() {
	Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index'); // 收货地址列表
	Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create'); // 新建收货地址
	Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store'); // 保存收货地址
	Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit'); // 编辑地址
	Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update'); 
 	Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy'); 
 	Route::post('products/{shopProduct}/favorite', 'ProductsController@favor')->name('products.favor'); // 用户收藏
    Route::delete('products/{shopProduct}/favorite', 'ProductsController@disfavor')->name('products.disfavor'); // 取消收藏
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites'); // 收藏列表
    Route::get('products/{shopProduct}', 'ProductsController@show')->name('products.show'); // 商品详情
    Route::post('cart', 'CartController@add')->name('cart.add'); // 添加购物车
    Route::get('cart', 'CartController@index')->name('cart.index'); // 查看购物车
    Route::delete('cart/{productSku}', 'CartController@remove')->name('cart.remove'); //购物车移除商品
    Route::post('orders', 'OrdersController@store')->name('orders.store'); // 创建订单
    Route::get('orders', 'OrdersController@index')->name('orders.index'); // 订单列表
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show'); // 订单详情
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay'); // 支付宝支付
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return'); // 支付宝前端回调
    Route::get('payment/{order}/paypal', 'PaymentController@payByPayPalCheckout')->name('payment.paypal'); // paypal支付
    Route::get('payment/paypal/return', 'PaymentController@payPalReturn')->name('payment.paypal.return'); // paypal前端回调
    
});

Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify'); // 支付宝后端回调
Route::post('payment/paypal/notify', 'PaymentController@payPalNotify')->name('payment.paypal.notify'); // Paypal支付回调









