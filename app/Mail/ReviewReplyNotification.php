<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewReplyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $replyMessage;
    public $reviewId;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $replyMessage , $reviewId)
    {
        $this->user = $user;
        $this->replyMessage = $replyMessage;
        $this->reviewId = $reviewId;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Someone replied to your review')
            ->view('emails.review_reply');
    }
}
