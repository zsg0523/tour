<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    // 数据被设置给公共属性后，将会在视图中自动生效
    public $name;

    public $email;

    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     * 在mail config 设置了全局发件人和收件人地址，姓名
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact');
    }
}
