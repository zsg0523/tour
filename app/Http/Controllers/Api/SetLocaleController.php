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
            session(['locale' => $request->lang]);
        }

        return $this->response->array(['message' => '多语言设置成功', 'lang' => $request->lang])->setStatusCode(201);      
    }
}
