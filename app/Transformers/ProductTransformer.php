<?php

/**
 * @Author: Eden
 * @Date:   2019-10-14 12:12:01
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-14 12:43:26
 */
namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['attributes', 'category'];

	public function transform(Product $product)
	{
		return [
			'id' => $product->id,
			'category_title' => $product->category->title,
			'name' => $product->name,
			'type' => $product->type,
			'cover' => url('uploads/' . $product->cover),
			'code' => $product->code,
			'local' => $product->local,
			'case' => $product->case,
			'size' => $product->size,
			'created_at' => $product->created_at->toDateTimeString(),
			'updated_at' => $product->updated_at->toDateTimeString()
		];
	}


	public function includeAttributes(Product $product)
	{
		return $this->collection($product->attributes, new AttributeTransformer());
	}

	public function includeCategory(Product $product)
	{
		return $this->item($product->category, new CategoryTransformer());
	}
}