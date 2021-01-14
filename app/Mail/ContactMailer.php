<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customerName = $this->data['customerName'];
        $customerEmail = $this->data['customerEmail'];
        $contactSubject = $this->data['contactSubject'];
        $email = $this->data['contactMessage'];
        return $this->from(env('MAIL_FROM_ADDRESS', 'phonetn2020@gmail.com'), env('MAIL_FROM_NAME', 'PHONETN STORE'))
            ->replyTo($customerEmail)
            ->subject($contactSubject)
            ->view('emails.contact-email')
            ->with('data', $this->data);
    }
}
