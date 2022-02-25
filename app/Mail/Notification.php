<?php

namespace App\Mail;

use App\Vacante;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    public $vacante;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vacante = $this->vacante;
        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('Nueva postulado registrado', compact('vacante'))
            ->view('mail_notification');

        // return $this->view('mail_notification')->with(['vacante' => $this->vacante]);
    }
}
