<?php

/**
 * @Author: eden
 * @Date:   2020-02-28 17:24:51
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-09 14:49:27
 */
namespace App\Services;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ShopProductSku;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use Carbon\Carbon;

class OrderService
{
    public function store(User $user, UserAddress $address, $remark, $items)
    {
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $address, $remark, $items) {
            // 更新此地址的最后使用时间
            $address->update(['last_used_at' => Carbon::now()]);
            
            // 创建一个订单
            $order   = new Order([
                'address'      => [ // 将地址信息放入订单中
                    'address_line1' => $address->address_line1,
                    'address_line2' => $address->address_line2,
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
            // 遍历用户提交的 SKU
            foreach ($items as $data) {
                $sku  = ShopProductSku::find($data['sku_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $sku->price,
                ]);
                $item->shopProduct()->associate($sku->shop_product_id);
                $item->shopProductSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('该商品库存不足');
                }
            }
            // 更新订单总金额
            $order->update(['total_amount' => $totalAmount]);

            // 将下单的商品从购物车中移除
            $skuIds = collect($items)->pluck('sku_id')->all();
            app(CartService::class)->remove($user, $skuIds);

            return $order;
        });

        // 这里我们直接使用 dispatch 函数
        dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }

    public function storeByGuest(User $user, $address, $remark, $items)
    {
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $address, $remark, $items) {
            
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
                'total_amount' => 0,
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();

            $totalAmount = 0;
            // 遍历用户提交的 SKU
            foreach ($items as $data) {
                $sku  = ShopProductSku::find($data['sku_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $sku->price,
                ]);
                $item->shopProduct()->associate($sku->shop_product_id);
                $item->shopProductSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('该商品库存不足');
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