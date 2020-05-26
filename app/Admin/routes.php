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

    $router->resource('themes', ThemeController::class); // 主题资料英文档
    $router->resource('themes-translations', ThemesTransController::class); // 主题资料翻译档案
    $router->resource('animals', AnimalController::class); //动物资料英文档
    $router->resource('animal-translations', AnimalsTransController::class); // 动物资料翻译档案
    $router->resource('animal-qrcodes', AnimalQrcodeController::class); // 动物资料库动物资料二维码

    $router->resource('questions', QuestionController::class); // 答题游戏

    $router->get('statistic', 'StatisticsController@index'); // 数据统计表格

    // 商城
    $router->resource('users', UsersController::class); // 用户管理
    $router->resource('shop-products', ShopProductsController::class); // 商品管理
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index'); // 订单列表
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show'); // 订单详情
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship'); // 发货
    $router->get('shop-categories', 'ShopCategoriesController@index');
    $router->get('shop-categories/create', 'ShopCategoriesController@create');
    $router->get('shop-categories/{id}/edit', 'ShopCategoriesController@edit');
    $router->post('shop-categories', 'ShopCategoriesController@store');
    $router->put('shop-categories/{id}', 'ShopCategoriesController@update');
    $router->delete('shop-categories/{id}', 'ShopCategoriesController@destroy');
    $router->resource('banners', BannerController::class); // 轮播图
    $router->get('banner/{id}/buttons', 'BannerController@buttons');
    $router->resource('buttons', ButtonController::class); // 轮播图按钮

});
