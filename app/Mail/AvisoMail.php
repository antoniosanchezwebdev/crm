<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AvisoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $vehiculo;

    public function __construct($client,$vehiculo)
    {
        $this->client = $client;
        $this->vehiculo = $vehiculo;
    }

    public function build()
    {
        return $this->subject('Aviso Neumalgex')
                    ->view('emails.aviso')
                    ->with([
                        'clientName' => $this->client->nombre,
                        'vehiculo' => $this->vehiculo
                    ]);
    }
}
