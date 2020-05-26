<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Buttons extends RowAction
{
    public $name = 'Buttons';


    public function href()
    {
    	$url = '/admin/banner/'. $this->getKey() . '/buttons';
    	// 页面跳转
        return url($url);
    }

}