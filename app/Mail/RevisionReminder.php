<?php

// namespace App\Mail;

// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue;

// class RevisionReminder extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $client;

//     public function __construct($client)
//     {
//         $this->client = $client;
//     }

//     public function build()
//     {
//         return $this->from('taller@example.com')
//                     ->view('emails.revisionreminder')
//                     ->with([
//                         'clientName' => $this->client->nombre,
//                     ]);
//     }
// }