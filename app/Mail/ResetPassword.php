<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $url;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->url = 'http://shoptreem.local/' . 'password/reset/' . $token . '?email=' . urlencode($this->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Client.auth.mail_content')
            ->subject('Shop Trẻ Em')
            ->with([
                'email'=> $this->email,
                'url'=> $this->url
            ]);
    }
}
