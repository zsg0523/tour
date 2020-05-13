<?php

namespace App\Listeners;

use App\Events\RegisteredByApi;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\VerifyEmailByApi;

class SendEmailVerificationNotificationByApi
{

    /**
     * Handle the event.
     *
     * @param  RegisteredByApi  $event
     * @return void
     */
    public function handle(RegisteredByApi $event)
    {
        if (!$this->hasVerifiedEmail($event->user)) {
            $this->sendEmailVerificationNotification($event->user);
        }
    }

    /** [hasVerifiedEmail 判断是否激活邮箱] */
    protected function hasVerifiedEmail($user)
    {
        return ! is_null($user->email_verified_at);
    }

    /** [sendEmailVerificationNotification 发送激活邮件] */
    protected function sendEmailVerificationNotification($user)
    {
        $user->notify(new VerifyEmailByApi);
    }





}
