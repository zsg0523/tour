<?php

/**
 * @Author: eden
 * @Date:   2020-02-28 16:57:34
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-17 10:42:44
 */
namespace App\Services;

use Auth;
use App\Models\CartItem;

class CartService
{
	/** [get 获取购物车列表] */
	public function get($user)
	{
        $cart['cart_items'] = $user->cartItems()->with(['shopProductSku.shopProduct'])->get();
        $cart['total_amount'] = $user->cartItems()->sum('amount');
		return $cart;
	}

    /** [add 添加购物车至数据库] */
	public function add($user, $skuId, $amount)
    {
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

    /** [deduct 扣减购物车商品数量] */
    public function deduct($user, $skuId, $amount)
    {
        // 从数据库中查询该商品是否已经在购物车中
        if ($item = $user->cartItems()->where('shop_product_sku_id', $skuId)->first()) {
            
            if ( $item->amount < 1 || $item->amount - $amount <= 0) {
                abort(403, '商品数量不足');
            }
            // 如果存在则直接叠加商品数量
            $item->update([
                'amount' => $item->amount - $amount,
            ]);
        }

        return $item;
    }

    /** [remove 移除购物车] */
    public function remove($user, $skuIds)
    {
        // 可以传单个 ID，也可以传 ID 数组
        if (!is_array($skuIds)) {
            $skuIds = [$skuIds];
        }
        $user->cartItems()->whereIn('shop_product_sku_id', $skuIds)->delete();
    }

}