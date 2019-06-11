<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AnimalRequest;
use App\Models\Animal;
use App\Transformers\AnimalTransformer;

class AnimalsController extends Controller
{
	/** [index 动物列表] */
    public function index(AnimalRequest $request)
    {
       $lang = $this->getLang($request); 

    	return $this->response->collection(Animal::all(), new AnimalTransformer($lang));
    }

    /** [show 动物详情] */
    public function show(AnimalRequest $request, Animal $animal)
    {
    	$lang = $this->getLang($request);

    	return $this->response->item($animal, new AnimalTransformer($lang));
    }

    /**
     * [getLang 获取当前语言]
     * @param  [type] $request [路由请求参数]
     * @return [type]          [description]
     */
    private function getLang($request)
    {
        $lang = $request->header('accept-language') ?? 'en';

        if ($lang == "") {
            return $this->errorResponse(404, '未选择语言！', 1001);
        }

        return $lang;
    }

}	
