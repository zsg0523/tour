<?php

/**
 * @Author: eden
 * @Date:   2020-06-10 10:58:02
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-07 17:37:11
 */
namespace App\Transformers;

use App\Models\OrderItem;
use League\Fractal\TransformerAbstract;

class OrderItemTransformer extends TransformerAbstract
{


	protected $availableIncludes = ['product'];


	public function transform(OrderItem $item)
	{

		return [
			'id' => $item->id,
			'order_id' => $item->order_id,
			'shop_product_id' => $item->shop_product_id,
			'amount' => $item->amount,
			'price' => $item->price,
			'rebate' => $item->rebate,
			'sales_price' => $item->sales_price,
			'rating' => $item->rating,
			'review' => $item->review,
			'reviewed_at' => $item->reviewed_at,
		];
	}

	public function includeProduct(OrderItem $item)
	{
		return $this->item($item->shopProduct, new ShopProductTransformer());
	}


}