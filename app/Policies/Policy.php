<?php

/**
 * @Author: Eden
 * @Date:   2019-05-22 15:46:42
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-05-22 15:47:03
 */
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        // 如果用户有管理内容权限，直接通过
        if ($user->can('manage_contents')) {
            return true;
        }
    }


}