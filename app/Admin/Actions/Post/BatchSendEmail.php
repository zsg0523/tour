<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\NewsLetter;
use Illuminate\Support\Facades\Mail;

class BatchSendEmail extends BatchAction
{
    public $name = 'Send Email';

    public function handle(Collection $collection)
    {
        foreach ($collection as $model) {
            Mail::to($model->email)->send(new NewsLetter());
        }

        return $this->response()->success('Success message...')->refresh();
    }

}