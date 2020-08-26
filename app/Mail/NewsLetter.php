<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsLetter extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $email, $image)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->email = $email;
        $this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.news_letter')
                    ->attach($this->image)
                    ->with([
                        'subject' => $this->subject,
                        'content' => $this->content,
                        'email' => $this->email,
                    ]);       
    }
}
