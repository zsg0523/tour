<?php

/**
 * @Author: eden
 * @Date:   2020-05-19 15:55:05
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-16 15:30:05
 */
namespace App\Transformers;

use App\Models\ShopProduct;
use League\Fractal\TransformerAbstract;

class ShopProductTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['skus'];

	public function transform(ShopProduct $product)
	{
		return [
			'id' => $product->id,
			'category_name' => $product->shopCategory->name,
			'title' => $product->title,
			'description' => $product->description,
			'price' => $product->price,
			'image_url' => $product->image_url,
		];
	}

	public function includeSkus(ShopProduct $product)
	{
		return $this->collection($product->skus, new ShopProductSkuTransformer());
	}




}