<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('brands', BrandController::class); // 首页品牌模块
    $router->resource('medias',MediaController::class); // 首页视频展示模块
    $router->resource('news', NewsController::class); // 新闻

});
