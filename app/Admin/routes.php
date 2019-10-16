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
    $router->resource('categories', CategoryController::class); // 产品分类
    $router->resource('products', ProductController::class); //产品
    $router->resource('attributes', AttibuteController::class); //产品参数
    $router->resource('abouts', AboutController::class); // About us
    $router->resource('locations', LocationController::class); // 零售地域
    $router->resource('retails', RetailController::class); // 零售店

});
