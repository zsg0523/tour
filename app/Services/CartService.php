<?php

/**
 * @Author: eden
 * @Date:   2020-02-28 16:57:34
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-23 09:19:42
 */
namespace App\Services;

use Auth;
use App\Models\CartItem;

class CartService
{
	/** [get 获取购物车列表] */
	public function get($user)
	{
        $cart['cart_items'] = $user->cartItems()->with(['shopProduct'])->get();
        $cart['total_amount'] = $user->cartItems()->sum('amount');
		return $cart;
	}

    /** [add 添加购物车至数据库] */
	public function add($user, $shop_product_id, $amount)
    {
        // 从数据库中查询该商品是否已经在购物车中
        if ($item = $user->cartItems()->where('shop_product_id', $shop_product_id)->first()) {
            // 如果存在则直接叠加商品数量
            $item->update([
                'amount' => $item->amount + $amount,
            ]);
        } else {
            // 否则创建一个新的购物车记录
            $item = new CartItem(['amount' => $amount]);
            $item->user()->associate($user);
            $item->shopProduct()->associate($shop_product_id);
            $item->save();
        }

        return $item;
    }

    /** [deduct 扣减购物车商品数量] */
    public function deduct($user, $shop_product_id, $amount)
    {
        // 从数据库中查询该商品是否已经在购物车中
        if ($item = $user->cartItems()->where('shop_product_id', $shop_product_id)->first()) {
            
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
    public function remove($user, $shop_product_ids)
    {
        // 可以传单个 ID，也可以传 ID 数组
        if (!is_array($shop_product_ids)) {
            $shop_product_ids = [$shop_product_ids];
        }
        $user->cartItems()->whereIn('shop_product_id', $shop_product_ids)->delete();
    }

}