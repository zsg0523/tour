<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Transformers\SaleTransformer;

class SalesController extends Controller
{

	public function __construct(Request $request)
    {
        $this->lang = $request->header('accept-language') ?? 'en';
    }

    
   	public function show()
   	{
   		$sale = Sale::where('is_show', 1)->where('lang', $this->lang)->first();

   		return $this->response->item($sale, new SaleTransformer());
   	}
}
