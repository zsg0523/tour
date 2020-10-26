<?php

/**
 * @Author: Eden
 * @Date:   2019-10-11 10:59:09
 * @Last Modified by:   Eden
 * @Last Modified time: 2020-10-26 15:53:57
 */
namespace App\Transformers;

use App\Models\Media;
use League\Fractal\TransformerAbstract;

class MediaTransformer extends TransformerAbstract
{
	public function transform(Media $media)
	{
		return [
			'id' => $media->id,
			'title' => $media->title,
			'media' => url('uploads/' . $media->media),
			'type' => $media->type,
			'location' => $media->location,
			'created_at' => $media->created_at->toDateTimeString(),
			'updated_at' => $media->updated_at->toDateTimeString()
		];
	}
}