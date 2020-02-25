<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopProduct;
use App\Exceptions\InvalidRequestException;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
    	// 创建一个查询构造器
    	$builder = ShopProduct::query()->where('on_sale', true);

    	// 判断是否提交search参数
    	// search 参数用来模糊搜索商品
    	if ($search = $request->input('search', '')) {
    		$like = '%' . $search .'%';

    		// 模糊搜索
    		$builder->where(function ($query) use ($like) {
    			$query->where('title', 'like', $like)
    				  ->orWhere('description', 'like', $like)
    				  ->orWhereHas('skus', function ($query) use ($like) {
    				  		$query->where('title', 'like', $like)
    				  			  ->orWhere('description', 'like', $like);
    				  });
    		});
    	}

    	// 是否有提交 order 参数
    	// order 参数用来控制商品的排序
    	if ($order = $request->input('order', '')) {
    		// 是否是以 _asc 或者 _desc 结尾
    		if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
    			// 如果字符串是以这三个字符串之一开头，说明是合法的排序
    			if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
    				// 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
    			}
    		}
    	}

    	$products = $builder->paginate(16);

    	return view('products.index', [
    		'products' => $products,
    		'filters' => [
    			'search' => $search,
    			'order' => $order,
    		],
    	]);
    }


    /** [show 商品详情] */
    public function show(ShopProduct $shopProduct, Request $request)
    {
        // 判断商品是否已上架
        if (!$shopProduct->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
            // boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($shopProduct->id));
        }

        return view('products.show', ['product' => $shopProduct, 'favored' => $favored]);
    }


    /** [favor 用户收藏] */
    public function favor(ShopProduct $shopProduct, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($shopProduct->id)) {
            return [];
        }
        // attach() 方法的参数可以是模型的 id，也可以是模型对象本身，因此这里还可以写成 attach($shopProduct->id)
        $user->favoriteProducts()->attach($shopProduct);

        return [];
    }

    /** [disfavor 取消用户收藏] */
    public function disfavor(ShopProduct $shopProduct, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($shopProduct);

        return [];
    }

    /** [favorites 用户收藏列表] */
    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }


    




























}
