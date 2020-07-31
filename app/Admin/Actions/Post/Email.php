<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Mail\NewsLetter;
use Illuminate\Support\Facades\Mail;

class Email extends RowAction
{
    public $name = 'Email';

    public function handle(Model $model, Request $request)
    {
    	// 获取表单中的邮件文本
    	$cc = $request->get('cc');
    	$subject = $request->get('subject');
    	$content = $request->get('content');
        $image = $request->image;
        $file = $request->file;
    	// 发送邮件
    	if ($cc) {
    		Mail::to($model->email)->cc($cc)->send(new NewsLetter($subject, $content));
    	} else {
    		Mail::to($model->email)->send(new NewsLetter($subject, $content, $image));
    	}

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
	{
		$this->email('cc', '抄送');
		$this->text('subject', '主题')->rules('required');
	    $this->textarea('content', '正文')->rules('required');
        $this->image('image', '图片');
	}

}