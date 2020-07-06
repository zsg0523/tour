<?php

/**
 * @Author: eden
 * @Date:   2020-07-01 14:19:25
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-06 11:03:10
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
			'color' => $sale->color,
			'background' => url('uploads/' . $sale->background),
			'is_show' => $sale->is_show,
 			'created_at' => $sale->created_at->toDateTimeString(),
			'updated_at' => $sale->updated_at->toDateTimeString()
		];
	}
}