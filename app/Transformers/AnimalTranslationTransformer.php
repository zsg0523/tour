<?php

/**
 * @Author: Eden
 * @Date:   2019-06-10 16:56:50
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-17 12:52:45
 */
namespace App\Transformers;

use App\Models\AnimalTranslation;
use League\Fractal\TransformerAbstract;

class AnimalTranslationTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['sound'];

	public function transform(AnimalTranslation $animaltranslation)
	{

		return [
			'id' => $animaltranslation->id,
			'animal_id' => $animaltranslation->animal_id,
			'sound_id' => $animaltranslation->sound_id,
			'lang' => $animaltranslation->lang,
			'title' => $animaltranslation->title,
			'genus' => $animaltranslation->genus,
			'family' => $animaltranslation->family,
			'habitat' => $animaltranslation->habitat,
			'location' => $animaltranslation->location,
			'title_classification' => $animaltranslation->title_classification,
			'classification' => $animaltranslation->classification,
			'title_lifespan' => $animaltranslation->title_lifespan,
			'title_diet' => $animaltranslation->title_diet,
			'diet' => $animaltranslation->diet,
			'weight' => $animaltranslation->weight,
			'speed' => $animaltranslation->speed,
			'animal_height' => $animaltranslation->animal_height,
			'title_fun_tips' => $animaltranslation->title_fun_tips,
			'fun_tips' => $animaltranslation->fun_tips,
			'endangered_level' => $animaltranslation->endangered_level,
			'created_at' => $animaltranslation->created_at ? $animaltranslation->created_at->toDateTimeString() : '',
			'updated_at' => $animaltranslation->updated_at ? $animaltranslation->created_at->toDateTimeString(): '',
		];
	}


	/** [includeStudent 获取动物的详细资料] */
	public function includeSound(AnimalTranslation $animaltranslation)
	{	

		$sound = $animaltranslation->sound;

		if ($sound) {
			return $this->item($sound, new SoundTransformer());
		}
		
	}
}