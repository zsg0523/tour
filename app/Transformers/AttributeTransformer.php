<?php

/**
 * @Author: Eden
 * @Date:   2019-10-14 12:27:06
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-14 12:38:32
 */
namespace App\Transformers;

use App\Models\Attribute;
use League\Fractal\TransformerAbstract;

class AttributeTransformer extends TransformerAbstract
{
	public function transform(Attribute $attribute)
	{
		return [
			// 'id' => $attribute->id,
			'content' => $attribute->content,
		];
	}
}