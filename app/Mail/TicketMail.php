<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        try {
            // Generate QR Code dengan multiple fallback methods
            $qrCode = $this->generateQRCode($this->order->barcode);

            if ($qrCode) {
                return $this->markdown('mail.ticket')
                    ->subject('Tiket AOM 10.0 - ' . $this->order->order_id)
                    ->with(['order' => $this->order])
                    ->attachData($qrCode, 'qr-code-' . $this->order->order_id . '.png', [
                        'mime' => 'image/png',
                    ]);
            } else {
                throw new \Exception('Failed to generate QR Code');
            }
        } catch (\Exception $e) {
            Log::error('Failed to build ticket email', [
                'error' => $e->getMessage(),
                'order_id' => $this->order->id ?? null,
                'barcode' => $this->order->barcode ?? null
            ]);

            // Fallback tanpa QR code
            return $this->markdown('mail.ticket-fallback')
                ->subject('Tiket AOM 10.0 - ' . ($this->order->order_id ?? 'Unknown'))
                ->with([
                    'order' => $this->order,
                    'orderId' => $this->order->order_id ?? null
                ]);
        }
    }

    private function generateQRCode($text)
    {
        // Method 1: SimpleSoftwareIO dengan Facade
        try {
            if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
                $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
                    ->size(200)
                    ->margin(2)
                    ->generate($text);

                Log::info('QR Code generated using SimpleSoftwareIO Facade');
                return $qr;
            }
        } catch (\Exception $e) {
            Log::warning('SimpleSoftwareIO Facade failed: ' . $e->getMessage());
        }

        // Method 2: SimpleSoftwareIO dengan Direct Class
        try {
            if (class_exists('SimpleSoftwareIO\QrCode\Generator')) {
                $generator = new \SimpleSoftwareIO\QrCode\Generator;
                $qr = $generator->format('png')->size(200)->margin(2)->generate($text);

                Log::info('QR Code generated using SimpleSoftwareIO Direct');
                return $qr;
            }
        } catch (\Exception $e) {
            Log::warning('SimpleSoftwareIO Direct failed: ' . $e->getMessage());
        }

        // Method 3: Milon DNS2D
        try {
            if (class_exists('Milon\Barcode\Facades\DNS2DFacade')) {
                $qr = DNS2D::getBarcodePNG($text, 'QRCODE', 8, 8);

                Log::info('QR Code generated using Milon DNS2D');
                return $qr;
            }
        } catch (\Exception $e) {
            Log::warning('Milon DNS2D failed: ' . $e->getMessage());
        }

        // Method 4: Milon Direct Class
        try {
            if (class_exists('Milon\Barcode\DNS2D')) {
                $generator = new \Milon\Barcode\DNS2D();
                $qr = $generator->getBarcodePNG($text, 'QRCODE', 8, 8);

                Log::info('QR Code generated using Milon Direct');
                return $qr;
            }
        } catch (\Exception $e) {
            Log::warning('Milon Direct failed: ' . $e->getMessage());
        }

        Log::error('All QR Code generation methods failed');
        return null;
    }
}