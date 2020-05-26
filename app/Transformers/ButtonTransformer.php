<?php

/**
 * @Author: eden
 * @Date:   2020-05-25 14:35:28
 * @Last Modified by:   eden
 * @Last Modified time: 2020-05-25 14:39:50
 */
namespace App\Transformers;

use App\Models\Button;
use League\Fractal\TransformerAbstract;

class ButtonTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['buttons'];

    public function transform(Button $button)
    {
        return [
            'id' => $button->id,
            'banner_id' => $button->banner_id,
            'link' => $button->link,
            'name' => $button->name,
            'icon' => $button->icon,
            'is_show' => $button->is_show,
            'created_at' => (string) $button->created_at,
            'updated_at' => (string) $button->updated_at,
        ];
    }


}