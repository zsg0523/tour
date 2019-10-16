<?php

/**
 * @Author: Eden
 * @Date:   2019-10-11 11:47:11
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-16 15:25:53
 */
namespace App\Transformers;

use App\Models\Brand;
use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
	public function transform(Brand $brand)
	{
		return [
			'id' => $brand->id,
			'lang' => $brand->lang,
			'image' => url('uploads/' . $brand->image),
			'title' => $brand->title,
			'content' => $brand->content,
			'created_at' => $brand->created_at->toDateTimeString(),
			'updated_at' => $brand->updated_at->toDateTimeString()
		];
	}
}