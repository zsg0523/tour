<?php

/**
 * @Author: eden
 * @Date:   2020-06-02 10:11:44
 * @Last Modified by:   eden
 * @Last Modified time: 2020-06-02 11:18:52
 */
namespace App\Transformers;

use App\Models\UserAddress;
use League\Fractal\TransformerAbstract;

class UserAddressTransformer extends TransformerAbstract
{
    public function transform(UserAddress $user_address)
    {
        return [
            'id' => $user_address->id,
            'user_id' => $user_address->user_id,
            'region' => $user_address->region,
            'receiver' => $user_address->receiver,
            'company' => $user_address->company,
            'address_line1' => $user_address->address_line1,
            'address_line2' => $user_address->address_line2,
            'phone' => $user_address->phone,
            'last_used_at' => $user_address->last_used_at,
            'created_at' => (string) $user_address->created_at,
            'updated_at' => (string) $user_address->updated_at,
        ];
    }
}