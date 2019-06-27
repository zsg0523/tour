<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    /**
     * 多语言设置
     */
    public function setLocale(Request $request)
    {
        if (in_array($request->lang, ['en', 'zh-CN', 'zh-HK'])) {
            session(['locale' => $request->lang ?? 'en']);
        }

        // api 设置本地化语言
        \App::setLocale($request->lang);

        return $this->response->array(['message' => 'change language success', 'lang' => $request->lang])->setStatusCode(201);      
    }
}