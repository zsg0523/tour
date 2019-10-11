<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{News, Media, Brand};
use App\Transformers\NewsTransformer;
use App\Transformers\MediaTransformer;
use App\Transformers\BrandTransformer;

class WebController extends Controller
{	
	/** [getNews 新闻列表] */
    public function getNews(Request $request)
    {
    	switch ($request->is_push) {
    		case '0':
    			$news = News::where('is_push', 0)->get();
    			break;
    		
    		case '1':
    			$news = News::where('is_push', 1)->get();
    			break;
    	}

    	return $this->response->collection($news, new NewsTransformer());
    }

    /** [getNewsData 新闻详情] */
    public function getNewsData(News $news)
    {
    	return $this->response->item($news, new NewsTransformer());
    }

    /**
     * [getMediaData 多媒体]
     * @param  Request $request [10/20/30 首页轮播/首页视频/产品轮播]
     * @return [type]           [description]
     */
    public function getMediaData(Request $request)
    {	
    	$location = trim($request->location);
    	$data = Media::where('location', $location)->get();

    	return $this->response->collection($data, new MediaTransformer());
    }

    /** [getBrand 品牌推广] */
    public function getBrand()
    {
    	return $this->response->collection(Brand::all(), new BrandTransformer());
    }





}
