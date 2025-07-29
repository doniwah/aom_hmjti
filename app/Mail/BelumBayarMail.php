<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BelumBayarMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data for the email.
     *
     * @var array
     */
    // public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.belumbayar')
            ->subject('Transaksi Belum Terbayar')
            ->with([
                'data' => $this->data,
            ]);
    }
}
