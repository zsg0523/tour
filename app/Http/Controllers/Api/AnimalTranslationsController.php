<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{AnimalTranslation, ThemesTranslation, Theme, Animal};
use App\Transformers\AnimalTranslationTransformer;
use DB;
use Illuminate\Database\Eloquent\Builder;

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
        // 獲取主題翻譯內容
        $themes = $this->getThemes($request);

        // 如果传入主题为空，则默认主题列表第一个主题
        $theme = empty($request->theme) ? trim($themes[0]['title_page']) : $request->theme;

        // 获取对应主题的动物列表
        $animals = AnimalTranslation::where('lang', $lang)->where('theme_name', $theme)->get();

    	return $this->response->collection($animals, new AnimalTranslationTransformer())->setMeta($themes);
    }

    /** 
     * [show 动物详情]
     * @param  Request           $request [theme_id、product_name、lang]
     * @param  AnimalTranslation $animal  [description]
     * @return [type]                     [description]
     */
    public function show(Request $request, AnimalTranslation $animal)
    {
    	$lang = $this->getLang($request);
        
        $animal_id = Animal::where('product_name', $request->product_name)->value('id');

        if ($request->theme_id) {
            // 判断 theme 是否开启
            if(Theme::find($request->theme_id)->is_show == false) {
                return $this->errorResponse(404, '该主题已关闭', 1001);
            }

            // 获取对应语言的theme_name
            $theme_name = ThemesTranslation::where('lang', $lang)->where('theme_id', $request->theme_id)->where('lang', $lang)->value('title_page');

            // 获取动物资料
            $animal = $animal->where('animal_id', $animal_id)->where('lang', $lang)->where('theme_name', $theme_name)->first();
            
        } else {
            $animal = $animal->where('animal_id', $animal_id)->where('lang', $lang)->first();
        }

        if (!$animal) {
            return $this->errorResponse(404, 'Coming soon!', 1002);
        }
        
        $animal->increment('view');

    	return $this->response->item($animal, new AnimalTranslationTransformer());
    }


    /**
     * [getLang 获取当前语言]
     * @param  [type] $request [路由请求参数]
     * @return [type]          [description]
     */
    private function getLang($request)
    {
        $lang = isset($request->lang) ? (session(['locale'=>$request->lang])?? $request->lang) : (session('locale') ?? 'en');

        if ($lang == "") {
            return $this->errorResponse(404, '未选择语言！', 1001);
        }

        return $lang;
    }

    /** [getThemes 获取主题] */
    private function getThemes($request)
    {
        
        $lang = isset($request->lang) ? (session(['locale'=>$request->lang])?? $request->lang) : (session('locale') ?? 'en');

        $theme_ids = Theme::where('is_show', 1)->orderBy('order', 'asc')->pluck('id');
        
        foreach ($theme_ids as $theme_id) {
            if (ThemesTranslation::where('lang', $lang)->where('theme_id', $theme_id)->select('theme_id', 'lang', 'title_page')->first()){
                $themes[] = ThemesTranslation::where('lang', $lang)->where('theme_id', $theme_id)->select('theme_id', 'lang', 'title_page')->first()->toArray();
            }
        }
        
        return $themes;
    }



















    
}
