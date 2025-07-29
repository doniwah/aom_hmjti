<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - AOM 10.0</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-header {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            text-align: center;
            padding: 40px 20px 30px;
            position: relative;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: bounce 1s ease-in-out;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
        }

        .success-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .success-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }

        .order-content {
            padding: 30px;
        }

        .order-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .detail-value {
            font-weight: bold;
            color: #212529;
            font-size: 14px;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .qr-section {
            text-align: center;
            background: #fff;
            border: 2px dashed #dee2e6;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .qr-title {
            font-size: 18px;
            font-weight: bold;
            color: #212529;
            margin-bottom: 15px;
        }

        .qr-code {
            margin: 20px 0;
            padding: 15px;
            background: white;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .qr-instruction {
            color: #6c757d;
            font-size: 14px;
            margin-top: 15px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .footer-note {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 13px;
            line-height: 1.4;
        }

        @media (max-width: 480px) {
            .action-buttons {
                flex-direction: column;
            }

            .success-container {
                margin: 10px;
            }

            .order-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <!-- Header Section -->
        <div class="success-header">
            <div class="success-icon">
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <h1 class="success-title">Pembayaran Berhasil!</h1>
            <p class="success-subtitle">Tiket Anda telah berhasil dibeli</p>
        </div>

        <!-- Content Section -->
        <div class="order-content">
            <!-- Order Details -->
            <div class="order-details">
                <div class="detail-item">
                    <span class="detail-label">Order ID</span>
                    <span class="detail-value">AOM-20250727092801-1642</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <span class="status-paid">Paid</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nama</span>
                    <span class="detail-value">Gold</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Tiket</span>
                    <span class="detail-value">General</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Bayar</span>
                    <span class="detail-value">Rp 35.000</span>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="qr-section">
                <h3 class="qr-title">Tiket Digital Anda</h3>
                <div class="qr-code">
                    <!-- QR Code akan dirender di sini -->
                    <div
                        style="width: 150px; height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin: 0 auto;">
                        <span style="color: #666; font-size: 12px;">QR Code</span>
                    </div>
                </div>
                <p class="qr-instruction">
                    <strong>Simpan dan tunjukkan QR Code ini saat penukaran tiket fisik.</strong><br>
                    QR Code juga telah dikirim ke email Anda.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
                <button onclick="window.print()" class="btn btn-secondary">Cetak Tiket</button>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="footer-note">
            <strong>Catatan Penting:</strong><br>
            • Tiket hanya berlaku untuk 1x penggunaan<br>
            • Harap tiba 30 menit sebelum acara dimulai<br>
            • Hubungi panitia jika mengalami kendala
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255,255,255,0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
