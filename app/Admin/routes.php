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

    // 商城
    $router->resource('users', UsersController::class);
});
