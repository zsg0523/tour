<?php

/**
 * @Author: eden
 * @Date:   2020-02-28 16:57:34
 * @Last Modified by:   eden
 * @Last Modified time: 2020-02-28 17:05:30
 */
namespace App\Services;

use Auth;
use App\Models\CartItem;

class CartService
{
	/** [get 获取购物车列表] */
	public function get()
	{
		return Auth::user()->cartItems()->with(['shopProductSku.shopProduct'])->get();
	}

	public function add($skuId, $amount)
    {
        $user = Auth::user();
        // 从数据库中查询该商品是否已经在购物车中
        if ($item = $user->cartItems()->where('shop_product_sku_id', $skuId)->first()) {
            // 如果存在则直接叠加商品数量
            $item->update([
                'amount' => $item->amount + $amount,
            ]);
        } else {
            // 否则创建一个新的购物车记录
            $item = new CartItem(['amount' => $amount]);
            $item->user()->associate($user);
            $item->shopProductSku()->associate($skuId);
            $item->save();
        }

        return $item;
    }

    public function remove($skuIds)
    {
        // 可以传单个 ID，也可以传 ID 数组
        if (!is_array($skuIds)) {
            $skuIds = [$skuIds];
        }
        Auth::user()->cartItems()->whereIn('shop_product_sku_id', $skuIds)->delete();
    }

}