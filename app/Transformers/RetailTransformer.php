<?php

/**
 * @Author: Eden
 * @Date:   2019-10-16 10:32:38
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-16 10:37:36
 */
namespace App\Transformers;

use App\Models\Retail;
use League\Fractal\TransformerAbstract;

class RetailTransformer extends TransformerAbstract
{
	public function transform(Retail $retail)
	{
		return [
			'id' => $retail->id,
			'name' => $retail->name,
			'address' => $retail->address,
			'phone' => $retail->phone,
			'business_hours' => $retail->business_hours,
			'created_at' => $retail->created_at->toDateTimeString(),
			'updated_at' => $retail->updated_at->toDateTimeString()
		];
	}
}