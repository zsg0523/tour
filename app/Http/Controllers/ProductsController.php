<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopProduct;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
    	$products = ShopProduct::query()->where('on_sale', true)->paginate(16);

    	return view('products.index', ['products' => $products]);
    }
}
