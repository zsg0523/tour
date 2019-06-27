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
        if (in_array($request->lang, ['en', 'zh-CN', 'zh-TW'])) {
            session(['locale' => $request->lang ?? 'en']);
        }

        return $this->response->array(['message' => 'change language success', 'lang' => $request->lang])->setStatusCode(201);      
    }
}
