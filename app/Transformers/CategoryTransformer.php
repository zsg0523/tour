<?php

/**
 * @Author: Eden
 * @Date:   2019-10-14 12:26:56
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-14 15:14:20
 */
namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['products'];

	public function transform(Category $category)
	{
		return [
			// 'id' => $category->id,
			'title' => $category->title,
		];
	}

	public function includeProducts(Category $category)
	{
		if ($category->products){
			return $this->collection($category->products, new ProductTransformer());
		}
	}
}