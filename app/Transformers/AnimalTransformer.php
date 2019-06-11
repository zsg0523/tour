<?php

/**
 * @Author: Eden
 * @Date:   2019-06-10 16:02:49
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-10 18:11:06
 */
namespace App\Transformers;

use App\Models\Animal;
use League\Fractal\TransformerAbstract;

class AnimalTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['translations'];

	/** [__construct 设置语言选择] */
	public function __construct($lang)
	{
		$this->lang = $lang;
	}

	public function transform(Animal $animal)
	{
		return [
			'id' => $animal->id,
			'name' => $animal->product_name,
			'image_family' => $animal->image_family,
			'image' => $animal->image,
			'code' => $animal->code,
			'image_endangeredLevel' => $animal->image_endangeredLevel,
			'icon_diet' => $animal->icon_diet,
			'background' => $animal->background,
			'back_button' => $animal->back_button,
			'sound_animal' => $animal->sound_animal,
			'background_bar' => $animal->background_bar,
			'youtube_url' => $animal->youtube_url,
			'created_at' => $animal->created_at->toDateTimeString(),
			'updated_at' => $animal->updated_at->toDateTimeString(),
		];
	}

	/** [includeStudent 获取动物的详细资料] */
	public function includeTranslations(Animal $animal)
	{
		if ($animal->translations) {

			$translation = $animal->translations()->where('lang', $this->lang)->first();

			return $this->item($translation, new AnimalTranslationTransformer());
		}
	}


}