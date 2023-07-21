<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DoubleOptin extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('from.address');
        return $this->view('emails.doubleoptin')->subject("verificació en dos pasos");
    }
}
