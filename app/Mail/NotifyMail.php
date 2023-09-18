<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 *
 */
class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $user;

    /**
     * @var Product
     */
    public Product $product;
    /**
     * Create a new message instance.
     */
    public function __construct(string $user, string $email, Product $product)
    {
        $this->user = $user;
        $this->email = $email;
        $this->product = $product;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notify Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.notify',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
