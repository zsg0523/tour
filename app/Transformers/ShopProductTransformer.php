<?php

/**
 * @Author: eden
 * @Date:   2020-05-19 15:55:05
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-03 17:27:34
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
			'rebate' => $product->rebate,
			'sales_price' => $product->sales_price,
			'image_url' => $product->image_url,
			'not_after' => (string)$product->not_after,
		];
	}




}