<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Transformers\ShopProductTransformer;
use App\Models\ShopProduct;
use App\Models\OrderItem;
use App\Models\ShopCategory;
use App\Services\CategoryService;

class ProductsController extends Controller
{

    /** 分类列表 */
    public function categoriesIndex(Request $request, CategoryService $categoryService)
    {
        $lang = $request->header('accept-language') ?? 'en';

        $categories = $categoryService->getCategoryTree($lang);
        // dd($categories);

        return $this->response->array($categories->toArray());
    }

	/** [index 商品列表] */
    public function index(Request $request, CategoryService $categoryService)
    {
    	$lang = $request->header('accept-language') ?? 'en';

    	// 创建查询构建器
    	$builder = ShopProduct::query()->where('on_sale', true)->where('lang', $lang);

    	// 判断是否提交search参数
    	// search 参数用来模糊搜索商品
    	if ($search = $request->input('search', '')) {
    		$like = '%' . $search .'%';
    		
    		// 模糊搜索
    		$builder->where(function ($query) use ($like) {
    			$query->where('title', 'like', $like)
    				  ->orWhere('description', 'like', $like);
    		});
    	}

    	// 如果传入shop_category_id 字段, 并且在数据库中有对应的类目
    	if ($request->input('shop_category_id') && $shopCategory = ShopCategory::find($request->input('shop_category_id'))) {
    		
    		
    		if ($shopCategory->is_directory) {
    			// 筛选出该父类目下的所有子类目商品
    			$builder->whereHas('shopCategory', function ($query) use ($shopCategory) {
                    $query->where('path', 'like', $shopCategory->path.$shopCategory->id.'-%');
    			});
    		} else {
    			$builder->where('shop_category_id', $shopCategory->id);
    		}
    		// 父类目列表
    		$category_parent = $shopCategory->ancestors;
    		$category_child = $shopCategory->children;
    	}

    	// 是否有提交 order 参数
    	// order 参数用来控制商品的排序
    	if ($order = $request->input('order', '')) {
    		// 是否是以 _asc 或者 _desc 结尾
    		if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
    			// 如果字符串是以这三个字符串之一开头，说明是合法的排序
    			if (in_array($m[1], ['price', 'sold_count', 'rating', 'created_at'])) {
    				// 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
    			}
    		}
    	}

        // 产品线 10/20/30 对应 Land/ Ocean/ Prehistoric
        if ($request->input('line')) {
            $builder->where('line', $request->input('line'));
        }

    	$products = $builder->orderBy('status', 'desc')->paginate(16);
    	
    	return $this->response->paginator($products, new ShopProductTransformer())->setMeta([
    		'categoryTree' => $categoryService->getCategoryTree($lang),
    		'category_parent' => $category_parent ?? [],
    		'category_child' => $category_child ?? [],
    	]);
    }

    /** [show 商品详情] */
    public function show(ShopProduct $product, Request $request)
    {
    	
        // 判断商品是否已上架
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if($user = $this->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
            // boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        // 商品评价
        $reviews = OrderItem::query()
                ->with(['order.user', 'shopProductSku']) // 预先加载关联关系
                ->where('shop_product_id', $product->id)
                ->whereNotNull('reviewed_at') // 筛选出已评价的
                ->orderBy('reviewed_at', 'desc') // 按评价时间倒序
                ->limit(10)
                ->get();
        return $this->response->item($product, new ShopProductTransformer())->setMeta([
        	'favored' => $favored, 
        	'reviews' => $reviews
        ]);
        
    }




}
