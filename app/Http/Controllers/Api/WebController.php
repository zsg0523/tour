<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{News, Media};
use App\Transformers\NewsTransformer;
use App\Transformers\MediaTransformer;

class WebController extends Controller
{	
	/** [getNews 新闻列表] */
    public function getNews()
    {
    	return $this->response->collection(News::all(), new NewsTransformer());
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




    
}
