<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCancellationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $bookingConfirmationTemplate;
    public $bookingMessage;
    public $bookingNameMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->data = $mailData;
        $this->bookingConfirmationTemplate = EmailTemplate::getTemplateByType('booking_cancellation');
        $this->bookingNameMessage  = str_replace("{First Name}",$mailData->summary,$this->bookingConfirmationTemplate->template_message ?? '');
        $this->bookingMessage  = str_replace("{Booking#}",'Booking Number '.$mailData->id,$this->bookingNameMessage ?? '');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Cancellation from JE Private Drivers')->view('email.booking-cancellation');
    }
}
