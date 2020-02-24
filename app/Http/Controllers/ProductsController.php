<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopProduct;

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
}
