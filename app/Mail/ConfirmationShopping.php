<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationShopping extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $url;

    public function __construct($order, $url)
    {
        $this->order = $order;
        $this->url = $url;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Confirmation Shopping',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.confirmation',
        );
    }

    public function attachments()
    {
        return [];
    }
}
