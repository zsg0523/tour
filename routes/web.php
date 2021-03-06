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
// 官网
Route::group(['middleware' => ['setLocale']], function() {

	Route::redirect('/', 'https://www.wennoanimal.com/website/');
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

	Route::get('aplasticocean', function () {
	    return view('newPage.aplasticocean');
	});

	// 在浏览器中预览邮件格式
	Route::get('mailable', function () {
		$order = App\Models\Order::find(67);
		$subject = "这是标题";
		$content = "According to scientists sloths have the slowest metabolism of any animal on Earth. Because of this they need to be frugal with their energy use. So they move slowly and tend not to wander far from their home ranges. Their bodies have evolved from large ground mammals to the tree dwelling sloths of today. They have incredible arm strength and specialized lungs to let them hang upside down for extended periods of time.";
	    $email = "shenggen93@163.com";
	    $view = "emails.zh-TW.newsletter";

	    // \Mail::to('shenggen93@163.com')->send(new App\Mail\Invoice($order));
	    return new App\Mail\NewsSignUp($email, $view);
	    // return new App\Mail\NewsLetter($subject, $content, $email, $image='');
	    // return new App\Mail\Invoice($order, $view);
	    // return new App\Mail\UserRegister($email, $view);
	});
});


// 商城
Route::group(['middleware' => ['setLocale']], function() {

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
	    Route::post('orders/{order}/received', 'OrdersController@received')->name('orders.received'); // 确认收货
	    Route::get('orders/{order}/review', 'OrdersController@review')->name('orders.review.show');	// 评论列表
  	 	Route::post('orders/{order}/review', 'OrdersController@sendReview')->name('orders.review.store'); // 提交评论
	    
	});

	Route::get('/user_info', function () { return view('user_info/index'); });
	Route::get('/user_info/edit', function () { return view('user_info/edit'); });
	Route::get('/user_info/change_email', function () { return view('user_info/email'); });
	Route::get('/user_info/pass', function () { return view('user_info/pass'); });
	Route::get('/contact', function () { return view('user_info/contact'); });
	Route::get('/aboutUs', function () { return view('user_info/aboutUs'); });
	Route::get('/retail', function () { return view('user_info/retail'); });

	Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify'); // 支付宝后端回调
	Route::post('payment/paypal/notify', 'PaymentController@payPalNotify')->name('payment.paypal.notify'); // Paypal支付回调

});










