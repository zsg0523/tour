<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnimalTranslation;
use App\Models\ThemesTranslation;
use App\Models\Theme;
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

        // 獲取主題翻譯內容
        $themes = $this->getThemes($request);

        $theme = $request->theme ?? $themes[0]['title_page'];

        $animals = AnimalTranslation::where('lang', $lang)->where('theme_name', $theme)->get();

    	return $this->response->collection($animals, new AnimalTranslationTransformer())->setMeta($themes->toArray());
    }

    /** [show 动物详情] */
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

    /** [getThemes 获取主题] */
    private function getThemes($request)
    {
        $lang = $request->header('accept-language') ?? 'en';

        $theme_ids = Theme::all()->pluck('id');

        $themes = ThemesTranslation::where('lang', $lang)->whereIn('theme_id', $theme_ids)->select('lang', 'title_page')->get();

        return $themes;
    }
}
