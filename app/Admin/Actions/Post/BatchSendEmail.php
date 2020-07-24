<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BatchSendEmail extends BatchAction
{
    public $name = 'Send Email';

    public function handle(Collection $collection, Request $request)
    {
        foreach ($collection as $model) {

            // 获取表单中的邮件文本
	    	$cc = $request->get('cc');
	    	$subject = $request->get('subject');
	    	$content = $request->get('content');

	    	// 发送邮件
	    	if ($cc) {
	    		Mail::to($model->email)->cc($cc)->send(new NewsLetter($subject, $content, $cc));
	    	} else {
	    		Mail::to($model->email)->send(new NewsLetter($subject, $content, $cc));
	    	}
        }

        return $this->response()->success('Success message...')->refresh();
    }

    public function form()
	{
		$this->email('cc', '抄送');
		$this->text('subject', '主题')->rules('required');
	    $this->textarea('content', '正文')->rules('required');
	}

}