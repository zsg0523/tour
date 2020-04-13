<?php

/**
 * @Author: eden
 * @Date:   2020-04-10 11:51:55
 * @Last Modified by:   eden
 * @Last Modified time: 2020-04-13 16:14:18
 */
namespace App\Transformers;

use App\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
	public function transform(Question $question)
	{
		return [
			'id' => $question->id,
			'code' => $question->code,
			'lang' => $question->lang,
			'question' => $question->question,
			'answer' => $question->answer,
			'true' => $question->true,
			'false' => $question->false,
			'total' => $question->total,
			'is_show' => $question->is_show,
			// 'created_at' => $question->created_at->toDateTimeString(),
			'updated_at' => $question->updated_at->toDateTimeString()
		];
	}
}