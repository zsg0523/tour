<?php

/**
 * @Author: eden
 * @Date:   2020-05-21 14:56:26
 * @Last Modified by:   eden
 * @Last Modified time: 2020-05-21 14:58:08
 */
namespace App\Transformers;

use App\Models\ShopProductSku;
use League\Fractal\TransformerAbstract;

class ShopProductSkuTransformer extends TransformerAbstract
{

	public function transform(ShopProductSku $productSku)
	{
		return [
			'id' => $productSku->id,
			'shop_product_id' => $productSku->shop_product_id,
			'title' => $productSku->title,
			'description' => $productSku->description,
			'price' => $productSku->price,
		];
	}



}