<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $factura;
    public $pdf;
    public $cliente;

    public function __construct($factura, $pdf,$cliente)
    {
        $this->factura = $factura;
        $this->pdf = $pdf;
        $this->cliente = $cliente;
    }

    public function build()
    {
        return $this->subject('Tu Factura de Neumalgex')
                    ->view('emails.factura')
                    ->attachData($this->pdf->output(), "Factura-{$this->factura->numero_factura}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}
