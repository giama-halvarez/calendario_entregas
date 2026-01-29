<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Marca;
use App\Operacion;

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
    public function __construct($subject, $operacion_id)
    {
        //
        $datos = Operacion::where('id', $operacion_id)->first();

        $datos->marca = Marca::where('id', $datos->marca_id)->first();

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
