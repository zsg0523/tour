<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnimalTranslation;
use App\Transformers\AnimalTranslationTransformer;

class AnimalTranslationsController extends Controller
{
	/**
	 * [index 动物列表]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function index(Request $request)
    {
    	$lang = $this->getLang($request); 
        $theme = $request->theme ?? '';
        $animals = AnimalTranslation::where('lang', $lang)->where('theme_name', $theme)->get();
    	return $this->response->collection($animals, new AnimalTranslationTransformer());
    }


    public function show(Request $request, AnimalTranslation $animal)
    {
    	$lang = $this->getLang($request);

    	return $this->response->item($animal, new AnimalTranslationTransformer());
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
