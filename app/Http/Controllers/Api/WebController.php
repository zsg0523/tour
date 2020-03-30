<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{News, Media, Brand, Product, Category, About, Location, Retail};
use App\Transformers\NewsTransformer;
use App\Transformers\MediaTransformer;
use App\Transformers\BrandTransformer;
use App\Transformers\ProductTransformer;
use App\Transformers\CategoryTransformer;
use App\Transformers\LocationTransformer;
use App\Transformers\RetailTransformer;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;

class WebController extends Controller
{	
    /**
     * [__construct 官网数据抓取，仅限简繁英]
     */
    public function __construct()
    {
        in_array(session('locale'), ['en', 'zh-CN', 'zh-TW']) ? $this->lang = session('locale') : $this->lang = 'en';
    }

	/**
     * [getNews description]
     * @param  Request $request [description]
     * @return [type]           [1推荐新闻， 0普通新闻，出现在列表里]
     */
    public function getNews(Request $request)
    {
        // 兼容APP多语言，检查是否传入lang参数
        isset($request->lang) ? $lang = $request->lang : $lang = $this->lang;

    	switch ($request->is_push) {
            // 推荐新闻，最多五条，按时间排序    		
    		case '1':
    			$news = News::where('is_push', 0)->where('lang', $lang)->orderBy('created_at', 'desc')->limit(5)->get();
    			return $this->response->collection($news, new NewsTransformer());
            // 新闻列表
            default:
                $news = News::where('is_push', 0)->where('lang', $lang)->orderBy('created_at', 'desc')->paginate(6);
                return $this->response->paginator($news, new NewsTransformer());
    	}
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
    	$data = Media::where('location', $location)->where('lang', $this->lang)->get();

    	return $this->response->collection($data, new MediaTransformer());
    }

    /** [getBrand 品牌推广] */
    public function getBrand()
    {
    	return $this->response->collection(Brand::where('lang', $this->lang)->get(), new BrandTransformer());
    }

    /** [getBrandData 品牌详情] */
    public function getBrandData(Brand $brand)
    {
    	return $this->response->item($brand, new BrandTransformer());
    }

    /**
     * [getProducts 产品列表]
     * @param  Request $request [10-单品， 20-套装]
     * @return [type]           [description]
     */
    public function getProducts(Request $request)
    {	
    	return $this->response->collection(Category::where('lang', $this->lang)->get(), new CategoryTransformer());
    }


    /** [getProduct 商品详情] */
    public function getProduct(Product $product)
    {
    	return $this->response->item($product, new ProductTransformer());
    }

    /** [getAboutUs About us] */
    public function getAboutUs()
    {
        return $this->response->array(About::where('lang', $this->lang)->first());
    }

    /** [contact contact us 发送邮件] */
    public function contact(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        
        Mail::to(config('mail.reply_to.address'))->send(new ContactUs($name, $email, $message));
    }

    /** [local 零售店地域] */
    public function local(Request $request)
    {
        if ($request->location) {
            $retails = Location::where('location', $request->location)->where('lang', $this->lang)->get();
        } else {
            $retails = Location::where('lang', $this->lang)->get();
        }
        return $this->response->collection($retails, new LocationTransformer());
    }

}
