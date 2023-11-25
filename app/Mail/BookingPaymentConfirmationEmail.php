<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingPaymentConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $bookingPaymentConfirmationTemplate;
    public $bookingMessage;
    public $paymentLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->data = $mailData;
        $customerName = $mailData['customer']->first_name;
        $this->bookingPaymentConfirmationTemplate = EmailTemplate::getTemplateByType('payment_confirmation');
        $this->bookingMessage = str_replace("{First Name}",$customerName,$this->bookingPaymentConfirmationTemplate->template_message ?? '');
        $this->paymentLink = url('/add-tip').'/'.$mailData->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Payment Confirmation from JE Private Drivers')->view('email.booking-payment-confirmation');
    }
}
