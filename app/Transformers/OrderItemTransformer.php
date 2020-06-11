<?php

/**
 * @Author: eden
 * @Date:   2020-06-10 10:58:02
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-10 14:50:16
 */
namespace App\Transformers;

use App\Models\OrderItem;
use League\Fractal\TransformerAbstract;

class OrderItemTransformer extends TransformerAbstract
{
	public function transform(OrderItem $item)
	{
		return [
			'id' => $item->id,
			'order_id' => $item->order_id,
			'shop_product_id' => $item->shop_product_id,
			'shop_product_sku_id' => $item->shop_product_sku_id,
			'amount' => $item->amount,
			'price' => $item->price,
			'rating' => $item->rating,
			'review' => $item->review,
			'reviewed_at' => $item->reviewed_at,
		];
	}
}