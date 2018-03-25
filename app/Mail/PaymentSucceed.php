<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSucceed extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
        https://myaccount.google.com/security
        https://support.google.com/accounts/answer/185833?hl=en
     */
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sonvotu96@gmail.com', 'Boss Long')->to('quoclongdng@gmail.com')->view('mails.welcome')->subject('Thanh Son');
    }
}
