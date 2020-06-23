<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\AddCartRequest;
use App\Models\ShopProductSku;
use App\Services\CartService;
use Illuminate\Support\Facades\Cookie;

class CartsController extends Controller
{
    protected $cartService;

    // 利用 Laravel 的自动解析功能注入 CartService 类
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /** [index 查看购物车] */
    public function index(Request $request)
    {   
        $cartItems = $this->cartService->get($this->user);
        
        return $this->response->array($cartItems);
    }



    /** [add 添加购物车] */
    public function add(AddCartRequest $request)
    {
        
        $this->cartService->add($this->user, $request->input('shop_product_id'), $request->input('amount'));
    
        return $this->response->array(
            [
                'message' => '加入购物车成功!',
                'status_code' => 201
            ]);
    }

    /** [cookie 购物车缓存录入数据库] */
    public function cookie(Request $request)
    {
        foreach (json_decode($request->items, true) as $item) {
            $this->cartService->add($this->user, $item['shop_product_id'], $item['amount']);
        }

        return $this->response->array(
            [
                'message' => '加入购物车成功!',
                'status_code' => 201
            ]);
    }

    /** [remove 减少商品数量] */
    public function deduct(Request $request)
    {
        $this->cartService->deduct($this->user, $request->input('shop_product_id'), $request->input('amount'));

        return $this->response->array(
            [
                'message' => '减少购物车成功!',
                'status_code' => 201
            ]);
    }


    /** [remove 商品移除购物车] */
    public function destroy(Request $request)
    {

        $this->cartService->remove($this->user, $request->shop_product_id);

        return $this->response->noContent();
    }


}
