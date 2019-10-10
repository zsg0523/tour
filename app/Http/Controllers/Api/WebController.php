<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\News;
use App\Transformers\NewsTransformer;

class WebController extends Controller
{	
	/**
	 * [getNews 获取新闻列表]
	 * @return [type] [description]
	 */
    public function getNews()
    {
    	return $this->response->collection(News::all(), new NewsTransformer());
    }

    /** [getNewsData 获取新闻详情] */
    public function getNewsData(News $news)
    {
    	return $this->response->item($news, new NewsTransformer());
    }
}
