<?php

/**
 * @Author: Eden
 * @Date:   2019-06-10 16:56:50
 * @Last Modified by:   eden
 * @Last Modified time: 2020-04-03 11:43:15
 */
namespace App\Transformers;

use App\Models\AnimalTranslation;
use League\Fractal\TransformerAbstract;

class AnimalTranslationTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['sound', 'animal'];

	public function transform(AnimalTranslation $animaltranslation)
	{

		return [
			'id' => $animaltranslation->id,
			'animal_id' => $animaltranslation->animal_id,
			'sound_id' => $animaltranslation->sound_id,
			'lang' => $animaltranslation->lang,
			'view' => $animaltranslation->view,
			'title' => $animaltranslation->title,
			'genus' => $animaltranslation->genus,
			'family' => $animaltranslation->family,
			'habitat' => $animaltranslation->habitat,
			'location' => $animaltranslation->location,
			'title_classification' => $animaltranslation->title_classification,
			'classification' => $animaltranslation->classification,
			'title_lifespan' => $animaltranslation->title_lifespan,
			'lifespan' => $animaltranslation->lifespan,
			'title_diet' => $animaltranslation->title_diet,
			'diet' => $animaltranslation->diet,
			'weight' => $animaltranslation->weight,
			'speed' => $animaltranslation->speed,
			'animal_height' => $animaltranslation->animal_height,
			'title_fun_tips' => $animaltranslation->title_fun_tips,
			'fun_tips' => $animaltranslation->fun_tips,
			'endangered_level' => $animaltranslation->endangered_level,
			'theme_name' => $animaltranslation->theme_name,
			'group_name' => $animaltranslation->group_name,
			'about' => $animaltranslation->about,
			'more_details' => $animaltranslation->more_details,
			'created_at' => $animaltranslation->created_at ? $animaltranslation->created_at->toDateTimeString() : '',
			'updated_at' => $animaltranslation->updated_at ? $animaltranslation->updated_at->toDateTimeString(): '',
		];
	}


	/** [includeStudent 音频资料] */
	public function includeSound(AnimalTranslation $animaltranslation)
	{	

		$sound = $animaltranslation->sound;

		if ($sound) {
			return $this->item($sound, new SoundTransformer());
		}
		
	}

	/** [includeAnimal 图片资料] */
	public function includeAnimal(AnimalTranslation $animaltranslation)
	{
		if ($animaltranslation->animal) {
			return $this->item($animaltranslation->animal, new AnimalTransformer());
		}
	}
}