<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Transformers\BannerTransformer;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = $request->header('accept-language') ?? 'en';

        $banners = Banner::where('is_show', 1)->where('lang', $lang)->get();
        
        return $this->response->collection($banners, new BannerTransformer());
    }


}
