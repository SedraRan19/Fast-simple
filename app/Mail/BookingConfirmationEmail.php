<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $bookingConfirmationTemplate;
    public $bookingMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->data = $mailData;
        $this->bookingConfirmationTemplate = EmailTemplate::getTemplateByType('booking_confirmation');
        $this->bookingMessage = str_replace("{First Name}",$mailData['customer'],$this->bookingConfirmationTemplate->template_message ?? '');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation from JE Private Drivers')->view('email.booking-confirmation');
    }
}
