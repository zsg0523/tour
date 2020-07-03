<?php

/**
 * @Author: eden
 * @Date:   2020-07-01 14:19:25
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-02 18:02:12
 */
namespace App\Transformers;

use App\Models\Sale;
use League\Fractal\TransformerAbstract;

class SaleTransformer extends TransformerAbstract
{
	public function transform(Sale $sale)
	{
		return [
			'id' => $sale->id,
			'lang' => $sale->lang,
			'title' => $sale->title,
			'description' => $sale->description,
			'background' => url('uploads/' . $sale->background),
			'is_show' => $sale->is_show,
 			'created_at' => $sale->created_at->toDateTimeString(),
			'updated_at' => $sale->updated_at->toDateTimeString()
		];
	}
}