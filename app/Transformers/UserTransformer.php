<?php

/**
 * @Author: eden
 * @Date:   2020-05-14 11:35:35
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-23 14:47:38
 */
namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'language' => $user->language,
            'is_newsletter' => $user->is_newsletter,
            'created_at' => (string) $user->created_at,
            'updated_at' => (string) $user->updated_at,
        ];
    }
}