<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnimalTranslation;

class SetLocaleController extends Controller
{
    /**
     * 多语言设置
     */
    public function setLocale(Request $request)
    {
        if (in_array($request->lang, ['en', 'zh-CN', 'zh-TW'])) {
            session(['locale' => $request->lang ?? 'en']);
        }

        return $this->response->array(['message' => 'change language success', 'lang' => $request->lang])->setStatusCode(201);      
    }

    /** [index 多语言列表] */
    public function index()
    {
        $lang = AnimalTranslation::groupBy('lang')->pluck('lang')->toArray();

        return $this->response->array($lang);
    }
}
