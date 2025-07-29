<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Picqer\Barcode\BarcodeGeneratorPNG;

class OfflineTransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($this->data['kode_barcode'], $generator::TYPE_CODE_128, 3, 30);
        
        $barcodeImg = $this->createBarcodeWithBackground($barcode, $this->data['kode_barcode']);
        
        // Attach the barcode as a PNG image to the email
        return $this->markdown('mail.offlineTransaction')
                    ->subject('Konfirmasi Pembayaran')
                    ->with([
                        'data' => $this->data,
                    ])
                    ->attachData($barcodeImg, 'barcode.png', [
                        'mime' => 'image/png',
                    ]);
    }

    public function createBarcodeWithBackground($barcode, $barcodeText)
    {
        // Create an image resource from the barcode data
        $barcodeImage = imagecreatefromstring($barcode);

        // Get the width and height of the barcode image
        $barcodeWidth = imagesx($barcodeImage);
        $barcodeHeight = imagesy($barcodeImage);

        // Create a new image with a background color
        $backgroundWidth = $barcodeWidth + 160;  // Add some padding
        $backgroundHeight = $barcodeHeight + 160 + 30;  // Add space for text

        // Create a new true color image for the background
        $backgroundImage = imagecreatetruecolor($backgroundWidth, $backgroundHeight);
        
        // dd(public_path('fonts/Arial.ttf'));


        // Set background color (e.g., white)
        $backgroundColor = imagecolorallocate($backgroundImage, 255, 255, 255);  // White background
        imagefill($backgroundImage, 0, 0, $backgroundColor);

        // Calculate the x and y coordinates to center the barcode on the background
        $x = ($backgroundWidth - $barcodeWidth) / 2;
        $y = ($backgroundHeight - $barcodeHeight) / 2;

        // Copy the barcode onto the background, centered
        imagecopy($backgroundImage, $barcodeImage, $x, $y, 0, 0, $barcodeWidth, $barcodeHeight);

        // Set the font for the text (path to your .ttf font file)
        $fontPath = public_path('fonts/Arial.ttf'); // Update this to your font path
        $fontSize = 16; // Font size
        $textColor = imagecolorallocate($backgroundImage, 0, 0, 0); // Black text

        // Add the text below the barcode
        $textY = $y + $barcodeHeight + 10; // 10 pixels below the barcode
        // Using built-in GD font
        imagestring($backgroundImage, 5, ($backgroundWidth - $barcodeWidth) / 2, $textY, $barcodeText, $textColor);


        // Save the image to a temporary stream
        ob_start();
        imagepng($backgroundImage);
        $imageData = ob_get_clean();

        // Clean up memory
        imagedestroy($barcodeImage);
        imagedestroy($backgroundImage);

        return $imageData;
    }
}
