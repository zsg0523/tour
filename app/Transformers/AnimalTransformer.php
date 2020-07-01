<?php

/**
 * @Author: Eden
 * @Date:   2019-06-10 16:02:49
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-01 10:31:36
 */
namespace App\Transformers;

use App\Models\Animal;
use League\Fractal\TransformerAbstract;

class AnimalTransformer extends TransformerAbstract
{

	public function transform(Animal $animal)
	{
		return [
			'id' => $animal->id,
			'product_name' => $animal->product_name,
			'image_family' => $animal->image_family,
			'cover' => $animal->cover,
			'image' => $animal->image,
			'image_original' => $animal->image_original,
			'image_resize' => $animal->image_resize,
			'image_thumbnail' => $animal->image_thumbnail,
			'code' => $animal->code,
			'image_endangeredLevel' => $animal->image_endangeredLevel,
			'background' => $animal->background,
			'back_button' => $animal->back_button,
			'sound_animal' => $animal->sound_animal,
			'background_bar' => $animal->background_bar,
			'youtube_url' => $animal->youtube_url,
			'created_at' => $animal->created_at->toDateTimeString(),
			'updated_at' => $animal->updated_at->toDateTimeString(),
		];
	}


}