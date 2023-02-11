<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contact = $this->contact;

        if (!empty($contact)) {
            $generalSettings = getGeneralSettings();

            return $this->subject('Youseed - Contact Form Submission')
                ->from('noreply@youseed.com.my')
                ->view('web.default.emails.contactForm', [
                    'contact' => $contact,
                    'generalSettings' => $generalSettings
                ]);
        }
    }
}
