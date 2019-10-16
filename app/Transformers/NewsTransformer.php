<?php

/**
 * @Author: Eden
 * @Date:   2019-10-10 16:50:59
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-16 15:47:55
 */
namespace App\Transformers;

use App\Models\News;
use League\Fractal\TransformerAbstract;

class NewsTransformer extends TransformerAbstract
{
	public function transform(News $news)
	{
		return [
			'id' => $news->id,
			'lang' => $news->lang,
			'title' => $news->title,
			'cover' => url('uploads/' . $news->cover),
			'introduction' => $news->introduction,
			'content' => $news->content,
			'created_at' => $news->created_at->toDateTimeString(),
			'updated_at' => $news->updated_at->toDateTimeString()
		];
	}
}