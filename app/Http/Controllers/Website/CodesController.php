<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Code;

class CodesController extends Controller
{
	/**
	 * [index 区号列表]
	 * @param  Request $request [search 模糊搜索参数]
	 * @return [type]           [城市名称：区号]
	 */
    public function index(Request $request)
    {
    	// 创建构造查询器
    	$builder = Code::query();

    	// search 参数用来模糊搜索商品
    	if ($search = $request->input('search', '')) {
    		$like = '%' . $search .'%';
    		
    		// 模糊搜索
    		$builder->where(function ($query) use ($like) {
    			$query->where('code', 'like', $like)
    				  ->orWhere('name', 'like', $like);
    		});
    	}

    	$codes = $builder->pluck('code','name');

    	return $this->response->array($codes);
    }


    /**
     * [rule 号码检查是否符合规则]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function rule(Request $request)
    {
    	$code  = $request->code;
    	$phone = $request->phone;

    	$rule = Code::where('code', $code)->value('rule');

    	if (strpos($rule, '_')) {
    		$rules = explode('_', $rule);

    		// 正则匹配m-n位数
	    	$pattern = '/^\d{'. $rules[0] . ',' .$rules[1] . '}$/';
            
	    	if (!preg_match($pattern, $phone)) {
	    		return $this->response->array([
	    			'status' => 401,
	    			'message'=> '手机格式错误'
	    		]);
	    	}
    	} else {
    		$rules = explode(',', $rule);
    		$int = 1;
    		foreach ($rules as $value) {
    			// 匹配n位数字^\d{n}$
    			$pattern = '/^\d{'. $value . '}$/';
    			if (preg_match($pattern, $phone)) {
    				$int = 0;
		    	}
    		}
    		
    		if ($int) {
    			return $this->response->array([
	    			'status' => 401,
	    			'message'=> '手机格式错误'
	    		]);
    		}
    	}

    }
    


    
}
