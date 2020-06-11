<?php

/**
 * @Author: eden
 * @Date:   2020-06-10 09:38:38
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-10 15:00:05
 */
namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
	protected  $availableIncludes = ['items'];

	public function transform(Order $order)
	{
		return [
			'id' => $order->id,
			'no' => $order->no,
			'user_id' => $order->user_id,
			'address' => $order->address,
			'total_amount' => $order->total_amount,
			'paid_at' => $order->paid_at,
			'payment_method' => $order->payment_method,
			'payment_no' => $order->payment_no,
			'ship_status' => $order->ship_status,
			'refund_status' => $order->refund_status,
			'refund_no' => $order->refund_no,
			'closed' => $order->closed,
			'reviewed' => $order->reviewed,
			'ship_data' => $order->ship_data,
			'extra' => $order->extra,
			'created_at' => (string)$order->created_at,
			'updated_at' => (string)$order->updated_at,
		];
	}

	public function includeItems(Order $order)
	{
		return $this->collection($order->items, new OrderItemTransformer());
	}
}
