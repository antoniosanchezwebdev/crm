<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $presupuesto;
    public $pdf;
    public $cliente;

    public function __construct($presupuesto, $pdf,$cliente)
    {
        $this->presupuesto = $presupuesto;
        $this->pdf = $pdf;
        $this->cliente = $cliente;
    }

    public function build()
    {
        return $this->subject('Tu Presupuesto de Neumalgex')
                    ->view('emails.presupuesto')
                    ->attachData($this->pdf->output(), "Presupuesto-{$this->presupuesto->numero_presupuesto}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}
