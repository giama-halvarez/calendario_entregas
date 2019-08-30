<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageAltaOperacion extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '';
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $datos)
    {
        //
        $this->subject = $subject;
        $this->msg = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mensaje_alta_operacion');
    }
}
