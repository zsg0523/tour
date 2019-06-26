<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    /**
     * 多语言设置
     */
    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'zh-CN', 'zh-HK'])) {
            session(['locale' => $locale]);
        }        
    }
}
