<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    // 手动注册模型中间件bindings
    'middleware' => ['serializer:array','bindings', 'web']
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
            /************************* wennoanimal ebook *****************************/
            $api->get('books', 'BooksController@index'); // 电子书
            $api->get('books/{book}', 'BooksController@show'); // 电子书封面
            $api->get('book/contents', 'BookContentsController@index'); // 所有电子书内容
            $api->get('book/contents/{content}', 'BookContentsController@show'); // 电子书详情

            /************************ wennoanimal database ****************************/
            $api->get('animals/sounds', 'AnimalsController@soundsIndex'); // 动物音频资料列表
            $api->get('animals/sounds/{sound}', 'AnimalsController@sounds'); // 动物音频资料详情
            $api->get('animals', 'AnimalTranslationsController@index'); // 动物列表
            $api->get('animal', 'AnimalTranslationsController@show'); // 动物详细资料
            $api->get('setLocale', 'SetLocaleController@setLocale'); // 多语言设置
            $api->get('lang', 'SetLocaleController@index'); // 多语言列表
            /*********************** wennoanimal Web ***********************************/
            $api->get('news', 'WebController@getNews'); // 新闻列表
            $api->get('news/{news}', 'WebController@getNewsData'); // 新闻详情
            $api->get('medias', 'WebController@getMediaData'); // 多媒体资料
            $api->get('brands', 'WebController@getBrand'); // 品牌推广
            $api->get('brands/{brand}', 'WebController@getBrandData'); // 品牌推广
            $api->get('products', 'WebController@getProducts'); // 产品列表
            $api->get('products/{product}', 'WebController@getProduct'); // 产品详情
            $api->get('about-us', 'WebController@getAboutUs'); // 关于我们
            $api->post('contact', 'WebController@contact'); //联系我们
            $api->get('locals', 'WebController@local'); // 零售地域

            /*********************** wennoanimal backend ********************************/
            $api->get('/admin/categories', 'AdminController@getCategories'); // 分类选项
            $api->get('/admin/answers', 'AdminController@getAnswers'); // 答案选项
            $api->get('/admin/locations', 'AdminController@getLocations'); // 地点选项
            $api->get('/admin/animals', 'AdminController@getAnimals'); // 动物选项
            $api->get('/admin/themes', 'AdminController@getThemes'); // 主题选项
            $api->post('/admin/up_image', 'AdminController@upImage'); // 上传文件
            $api->post('/qrcode', 'AdminController@generateQrcode'); // 生成二维码

            $api->get('/url', 'AnimalsController@images');

            /*********************** wennoanimal questions game *************************/
            $api->post('questions', 'QuestionsController@store'); // 用户答题
            $api->get('total', 'QuestionsController@total'); // 答题计数
            $api->get('questions', 'QuestionsController@index'); // 题目列表
            $api->get('questions/{question}', 'QuestionsController@show'); // 题目详情
            $api->post('questions/{question}', 'QuestionsController@answer'); // 回答

        });



});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Website',
    // 手动注册模型中间件bindings
    'middleware' => ['serializer:array','bindings', 'web']
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
            /*********************** wennoanimal Web ***********************************/
            $api->get('email/verify/{id}', 'UsersController@markEmailAsVerified')->name('api.verify')->middleware('signed');; // 邮箱激活
            
        });


    
});


$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Website',
    // 手动注册模型中间件bindings
    'middleware' => ['serializer:array','bindings', 'web']
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {

            /*********************** wennoanimal Web ***********************************/
            $api->get('blogs', 'BlogsController@getNews'); // 博客列表
            $api->get('blogs/{blogs}', 'BlogsController@getNewsData'); // 博客详情
            $api->post('users', 'UsersController@store'); // 用户邮箱注册
            $api->post('authorizations', 'AuthorizationsController@store'); // 邮箱登录
            $api->get('email/verify/{id}', 'UsersController@markEmailAsVerified')->name('api.verify')->middleware('signed');; // 邮箱激活
            $api->get('urls/test', 'UsersController@testUrl'); // 签名URL测试
            $api->get('user', 'UsersController@me'); // 当前登录用户信息
            /*********************** 接口版本测试 ****************************************/
            $api->get('version', function () {
                return response('this is version2');
            });
            
        });


    
});