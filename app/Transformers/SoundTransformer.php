<?php

/**
 * @Author: Eden
 * @Date:   2019-06-17 10:54:32
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-06-17 12:54:34
 */
namespace App\Transformers;

use App\Models\Sound;
use League\Fractal\TransformerAbstract;

class SoundTransformer extends TransformerAbstract
{

    public function transform(Sound $sound)
    {
        return [
            'id' => $sound->id,
            'lang' => $sound->lang,
            'name' => $sound->name,
            'path' => $sound->path,
            'type' => $sound->type,
        ];
    }

}