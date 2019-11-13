<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnimalTransImport;
use App\Models\AnimalTranslation;

class ImportPost extends Action
{
    protected $selector = '.import-post';

    public function handle(Request $request)
    {

        // 下面的代码获取到上传的文件，然后使用`maatwebsite/excel`等包来处理上传你的文件，保存到数据库
        // AnimalTranslation::truncate();

        Excel::import(new AnimalTransImport, $request->file('file'));

        return $this->response()->success('Success message...')->refresh();
    }

    public function form()
    {
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post"><i class="fa fa-upload"></i>Import</a>
HTML;
    }
}