<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;
use App\Models\ShopProductSku;

class CartController extends Controller
{
    /** [add 添加购物车] */
    public function add(AddCartRequest $request)
    {
        $user = $request->user();
        $skuId = $request->input('sku_id');
        $amount = $request->input('amount');

        // 从数据库中查询该商品是否已经在购物车中
        if ($cart = $user->cartItems()->where('shop_product_sku_id', $skuId)->first()) {

            // 如果存在则直接叠加商品数量
            $cart->update([
                'amount' => $cart->amount + $amount,
            ]);
        } else {

            // 否则创建一个新的购物车记录
            $cart = new CartItem(['amount' => $amount]);
            $cart->user()->associate($user);
            $cart->shopProductSku()->associate($skuId);
            $cart->save();
        }

        return [];
    }

    /** [remove 商品移除购物车] */
    public function remove(ShopProductSku $productSku, Request $request)
    {   
        $request->user()->cartItems()->where('shop_product_sku_id', $productSku->id)->delete();

        return [];
    }

    /** [index 查看购物车] */
    public function index(Request $request)
    {
        $cartItems = $request->user()->cartItems()->with(['ShopProductSku.shopProduct'])->get();

        return view('cart.index', ['cartItems' => $cartItems]);
    }

}
