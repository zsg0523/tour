<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\SfLocker;
use App\Transformers\SfLockerTransformer;

class SflockerController extends Controller
{
   	// SF locker 列表
   	public function index(Request $request)
   	{
   		$lang = $request->header('accept-language') ?? 'en';

    	// 创建查询构建器
    	$builder = SfLocker::query()->where('lang', $lang);

    	// 判断是否提交search参数
    	// search 参数用来模糊搜索商品
    	if ($search = $request->input('search', '')) {
    		$like = '%' . $search .'%';
    		
    		// 模糊搜索
    		$builder->where(function ($query) use ($like) {
    			$query->where('region', 'like', $like)
    				  ->orWhere('district', 'like', $like)
    				  ->orWhere('address', 'like', $like);
    		});
    	}

    	// 如果传入shop_category_id 字段, 并且在数据库中有对应的类目
    	if ($request->input('region')) {
    			$builder->where('region', $request->input('region'));
    	}

    	if ($request->input('district')) {
    			$builder->where('district', $request->input('district'));
    	}
    	// 区
    	$region = SfLocker::all()->where('lang', $lang)->pluck('region')->unique()->values()->all();
    	// 小区
    	$district = SfLocker::all()->where('lang', $lang)->pluck('district')->unique()->values()->all();

    	$lockers = $builder->paginate(16);
    	
    	return $this->response->paginator($lockers, new SfLockerTransformer())->setMeta([
    		'region' => $region ?? [],
    		'district' => $district ?? [],
    	]);
   	}
}
