<?php

/**
 * @Author: eden
 * @Date:   2020-05-25 11:19:30
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-16 11:06:40
 */
namespace App\Transformers;

use App\Models\Banner;
use League\Fractal\TransformerAbstract;

class BannerTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['buttons'];

    public function transform(Banner $banner)
    {
        return [
            'id' => $banner->id,
            'type' => $banner->type,
            'tag_line' => $banner->tag_line,
            'image' => url('uploads/' . $banner->image),
            'is_show' => $banner->is_show,
            'created_at' => (string) $banner->created_at,
            'updated_at' => (string) $banner->updated_at,
        ];
    }

    /**
     * [includeContents]
     * @param  Book   $book [description]
     * @return [type]       [description]
     */
    public function includeButtons(Banner $banner)
    {
    	if($banner->buttons){
			return $this->collection($banner->buttons()->where('is_show', 1)->get(), new ButtonTransformer());
		}
    }
}