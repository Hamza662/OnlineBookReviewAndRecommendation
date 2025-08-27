<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookRecommendationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $book;
    public $recommenderName;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $book, $recommenderName = null)
    {
        $this->user = $user;
        $this->book = $book;
        $this->recommenderName = $recommenderName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Book Recommendation for You')
            ->view(' emails.recommendation');
    }

    /**
     * Attachments (optional).
     */
    public function attachments(): array
    {
        return [];
    }
}
