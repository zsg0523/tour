<?php

/**
 * @Author: Eden
 * @Date:   2019-10-10 15:55:19
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-14 15:52:53
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

        $this->script = <<<EOT

var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.debug = location.href.indexOf('wangeditor_debug_mode=1') > 0
editor.customConfig.zIndex = 0
editor.customConfig.uploadImgShowBase64 = true
editor.customConfig.onchange = function (html) {
    $('input[name=\'$name\']').val(html);
}
editor.create()

EOT;
        return parent::render();
    }
}