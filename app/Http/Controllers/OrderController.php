<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\TicketMail;
use Illuminate\Support\Str;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class OrderController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function buyTicket(Request $request)
    {
        try {
            $request->validate([
                'no_telp' => 'required|numeric',
                'nama_ticket' => 'required|string',
                'totalHarga' => 'required|numeric'
            ]);

            $request->validate([
                'totalHarga' => 'required|numeric|min:10000|max:200000' // Sesuaikan batas maksimal
            ]);

            Log::info('Total Harga Received:', [
                'input' => $request->totalHarga,
                'converted' => (float)$request->totalHarga
            ]);

            $orderId = 'AOM-' . date('YmdHis') . '-' . mt_rand(1000, 9999);

            // Create order
            $transaction = Order::create([
                'order_id' => $orderId,
                'name' => $request->nama_ticket,
                'phone' => $request->no_telp,
                'total_price' => $request->totalHarga,
                'status' => 'pending',
                'user_id' => Auth::id()
            ]);

            // Midtrans config
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId, // Gunakan order_id yang sama
                    'gross_amount' => $transaction->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => $request->no_telp,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Update menggunakan order_id
            Order::where('order_id', $orderId)->update(['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'snapToken' => $snapToken,
                'redirectUrl' => route('payment.page', ['snap_token' => $snapToken])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString() // Untuk debugging
            ], 500);
        }
    }

    public function paymentNotification(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;
        $order_id = $notif->order_id;

        // Cari transaksi di database
        $trx = Order::where('order_id', $order_id)->first();

        if (!$trx) {
            return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404);
        }

        // Handle status transaksi
        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $trx->status = 'challenge';
            } else if ($fraud == 'accept') {
                $trx->status = 'success';
            }
        } else if ($transaction == 'settlement') {
            $trx->status = 'success';
        } else if ($transaction == 'cancel' || $transaction == 'deny' || $transaction == 'expire') {
            $trx->status = 'failed';
        } else if ($transaction == 'pending') {
            $trx->status = 'pending';
        }

        $trx->save();

        return response()->json(['status' => 'success']);
    }

    public function paymentSuccess(Request $request)
    {
        try {
            $orderId = $request->query('order_id');

            if (!$orderId) {
                return redirect('/')->with('error', 'Order ID tidak ditemukan');
            }

            $order = Order::with(['user', 'ticket'])
                ->where('order_id', $orderId)
                ->first();

            if (!$order) {
                return redirect('/')->with('error', 'Order tidak ditemukan');
            }

            // Generate barcode jika belum ada
            if (empty($order->barcode)) {
                $barcode = 'AOM-' . date('YmdHis') . '-' . mt_rand(1000, 9999);
                $order->update([
                    'barcode' => $barcode,
                    'status' => 'paid'
                ]);
                $order->refresh();
            }

            Log::info('Generating QR Code for barcode: ' . $order->barcode);

            // Generate QR Code dengan detailed logging
            $qrcode = $this->generateWebQRCode($order->barcode);

            if ($qrcode) {
                Log::info('QR Code generated successfully, length: ' . strlen($qrcode));
            } else {
                Log::error('QR Code generation failed');
            }

            // Kirim email
            try {
                if ($order->user && $order->user->email) {
                    \Mail::to($order->user->email)->send(new \App\Mail\TicketMail($order));
                    Log::info('Email sent successfully', ['email' => $order->user->email]);
                }
            } catch (\Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
            }

            return view('payment.success', [
                'order' => $order,
                'qrcode' => $qrcode,
                'debug_barcode' => $order->barcode // Untuk debugging
            ]);
        } catch (\Exception $e) {
            Log::error('Payment success error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return view('errors.500', [
                'errorMessage' => config('app.debug') ? $e->getMessage() : null
            ]);
        }
    }

    private function generateWebQRCode($text)
    {
        Log::info('Attempting to generate QR Code for: ' . $text);

        // Method 1: SimpleSoftwareIO dengan try-catch detail
        try {
            Log::info('Trying SimpleSoftwareIO method...');

            if (!class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
                Log::error('SimpleSoftwareIO\QrCode\Facades\QrCode class not found');
            } else {
                $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
                    ->size(200)
                    ->margin(2)
                    ->generate($text);

                Log::info('SimpleSoftwareIO QR generated, size: ' . strlen($qr));
                return base64_encode($qr);
            }
        } catch (\Exception $e) {
            Log::error('SimpleSoftwareIO failed: ' . $e->getMessage());
            Log::error('SimpleSoftwareIO stack trace: ' . $e->getTraceAsString());
        }

        // Method 2: Milon DNS2D dengan try-catch detail
        try {
            Log::info('Trying Milon DNS2D method...');

            if (!class_exists('Milon\Barcode\Facades\DNS2D')) {
                Log::error('Milon\Barcode\Facades\DNS2D class not found');
            } else {
                $qr = \Milon\Barcode\Facades\DNS2D::getBarcodePNG($text, 'QRCODE', 8, 8);

                Log::info('Milon DNS2D QR generated, size: ' . strlen($qr));
                return base64_encode($qr);
            }
        } catch (\Exception $e) {
            Log::error('Milon DNS2D failed: ' . $e->getMessage());
            Log::error('Milon DNS2D stack trace: ' . $e->getTraceAsString());
        }

        // Method 3: Direct instantiation SimpleSoftwareIO
        try {
            Log::info('Trying direct SimpleSoftwareIO instantiation...');

            if (class_exists('SimpleSoftwareIO\QrCode\Generator')) {
                $generator = new \SimpleSoftwareIO\QrCode\Generator;
                $qr = $generator->format('png')->size(200)->margin(2)->generate($text);

                Log::info('Direct SimpleSoftwareIO QR generated, size: ' . strlen($qr));
                return base64_encode($qr);
            }
        } catch (\Exception $e) {
            Log::error('Direct SimpleSoftwareIO failed: ' . $e->getMessage());
        }

        Log::error('All QR Code generation methods failed');
        return null;
    }

    public function paymentPending(Request $request)
    {
        $orderId = $request->query('order_id');
        // Update status transaksi di database
        return view('payment-status', [
            'status' => 'pending',
            'orderId' => $orderId
        ]);
    }

    public function paymentError(Request $request)
    {
        $orderId = $request->query('order_id');
        // Update status transaksi di database
        return view('payment-status', [
            'status' => 'error',
            'orderId' => $orderId
        ]);
    }
}