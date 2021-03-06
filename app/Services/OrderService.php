<?php

/**
 * @Author: eden
 * @Date:   2020-02-28 17:24:51
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-21 16:02:00
 */
namespace App\Services;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ShopProduct;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use Carbon\Carbon;
use App\Models\CouponCode;
use App\Exceptions\CouponCodeUnavailableException;

class OrderService
{
    public function store(User $user, UserAddress $address, $remark, $items, CouponCode $coupon = null)
    {
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $address, $remark, $items, $coupon) {
            // 更新此地址的最后使用时间
            $address->update(['last_used_at' => Carbon::now()]);
            
            // 创建一个订单
            $order   = new Order([
                'address'      => [ // 将地址信息放入订单中
                    'address_line1' => $address->address_line1,
                    'address_line2' => $address->address_line2 ?? '',
                    'region' => $address->region,
                    'receiver' => $address->receiver,
                    'phone' => $address->phone,
                ],
                'remark'       => $remark,
                'total_amount' => 0,
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();

            $totalAmount = 0;
            // 遍历用户提交的商品
            foreach ($items as $data) {
                $product  = ShopProduct::find($data['shop_product_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $product->price,
                    'rebate' => $product->rebate,
                    'sales_price' => $product->sales_price,
                ]);
                $item->shopProduct()->associate($product->id);
                $item->save();
                // 促销产品按促销价结算
                if ($product->sales) {
                    $totalAmount += $product->sales_price * $data['amount'];
                } else {
                    $totalAmount += $product->price * $data['amount'];
                }
            }

            if ($coupon) {
                // 总金额已经计算出来了，检查是否符合优惠券规则
                $coupon->checkAvailable($totalAmount);
                // 把订单金额修改为优惠后的金额
                $totalAmount = $coupon->getAdjustedPrice($totalAmount);
                // 将订单与优惠券关联
                $order->couponCode()->associate($coupon);
                // 增加优惠券的用量，需判断返回值
                if ($coupon->changeUsed() <= 0) {
                    throw new CouponCodeUnavailableException('该优惠券已被兑完');
                }
            }

            // 更新订单总金额
            $order->update(['total_amount' => $totalAmount]);

            // 将下单的商品从购物车中移除
            $productIds = collect($items)->pluck('shop_product_id')->all();
            
            app(CartService::class)->remove($user, $productIds);

            return $order;
        });

        // 这里我们直接使用 dispatch 函数
        dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }

    public function storeByGuest(User $user, $address, $remark, $items, $email, CouponCode $coupon = null)
    {
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $address, $remark, $items, $email, $coupon) {
            
            // 创建一个订单
            $order   = new Order([
                'address'      => [ // 将地址信息放入订单中
                    'address_line1' => $address['address_line1'],
                    'address_line2' => $address['address_line2'],
                    'region' => $address['region'],
                    'receiver' => $address['receiver'],
                    'phone' => $address['phone'],
                ],
                'remark'       => $remark,
                'email' => $email,
                'total_amount' => 0,
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();

            $totalAmount = 0;
            // 遍历用户提交的 SKU
            foreach ($items as $data) {
                $product  = ShopProduct::find($data['shop_product_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $product->price,
                    'rebate' => $product->rebate,
                    'sales_price' => $product->sales_price,
                ]);
                $item->shopProduct()->associate($product->id);
                $item->save();
                // 促销产品按促销价结算
                if ($product->sales) {
                    $totalAmount += $product->sales_price * $data['amount'];
                } else {
                    $totalAmount += $product->price * $data['amount'];
                }
                
            }
            if ($coupon) {
                // 总金额已经计算出来了，检查是否符合优惠券规则
                $coupon->checkAvailable($totalAmount);
                // 把订单金额修改为优惠后的金额
                $totalAmount = $coupon->getAdjustedPrice($totalAmount);
                // 将订单与优惠券关联
                $order->couponCode()->associate($coupon);
                // 增加优惠券的用量，需判断返回值
                if ($coupon->changeUsed() <= 0) {
                    throw new CouponCodeUnavailableException('该优惠券已被兑完');
                }
            }
            
            // 更新订单总金额
            $order->update(['total_amount' => $totalAmount]);

            return $order;
        });

        // 这里我们直接使用 dispatch 函数
        dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }


}