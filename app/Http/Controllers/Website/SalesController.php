<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\ShopProduct;
use App\Transformers\SaleTransformer;
use App\Transformers\ShopProductTransformer;
use Carbon\Carbon;

class SalesController extends Controller
{

	public function __construct(Request $request)
    {
        $this->lang = $request->header('accept-language') ?? 'en';
    }

    /** [show 促销设置] */
   	public function show()
   	{
   		$sale = Sale::where('is_show', 1)->where('lang', $this->lang)->first();

   		return $this->response->item($sale, new SaleTransformer());
   	}

   	/** [saleProducts 促销产品] */
   	public function saleProducts()
   	{
   		// 上架，促销，在下架时间内
   		$sales = ShopProduct::where('on_sale', 1)->where('sales', 1)->where('not_after', '>', Carbon::now())->get();

   		return $this->response->collection($sales, new ShopProductTransformer());
   		
   	}
























}
