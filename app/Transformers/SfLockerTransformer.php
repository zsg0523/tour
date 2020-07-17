<?php

/**
 * @Author: eden
 * @Date:   2020-07-17 16:38:00
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-17 16:39:56
 */
namespace App\Transformers;

use App\Models\SfLocker;
use League\Fractal\TransformerAbstract;

class SfLockerTransformer extends TransformerAbstract
{

	public function transform(SfLocker $locker)
	{
		return [
			'id' => $locker->id,
			'region' => $locker->region,
			'district' => $locker->district,
			'code' => $locker->code,
			'address' => $locker->address,
			'business_time' => $locker->business_time,
		];
	}

}