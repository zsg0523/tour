<?php

/**
 * @Author: Eden
 * @Date:   2019-10-10 15:55:19
 * @Last Modified by:   eden
 * @Last Modified time: 2020-03-20 15:46:00
 */
namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $css = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.min.css',
    ];

    protected static $js = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.min.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);
        $token = csrf_token();

        $this->script = <<<EOT

var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.zIndex = 0
editor.customConfig.uploadImgMaxSize = 50 * 1024 * 1024,
editor.customConfig.uploadImgServer = '/api/admin/up_image';
editor.customConfig.uploadFileName = "upload_file";
editor.customConfig.uploadImgParams = {
    _token: '{$token}'  
}
editor.customConfig.onchange = function (html) {
    $('input[name=\'$name\']').val(html);
}
editor.create()

EOT;
        return parent::render();
    }
}