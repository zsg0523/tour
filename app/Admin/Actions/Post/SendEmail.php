<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Mail\NewsLetter;
use Illuminate\Support\Facades\Mail;


class SendEmail extends RowAction
{
    public $name = 'Send Email';

    public function handle(Model $model)
    {
        // $model ...
    	Mail::to($model->email)->send(new NewsLetter());
    	
        return $this->response()->success('Success message.')->refresh();
    }

}