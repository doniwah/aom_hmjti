<!DOCTYPE html>
<html>

<head>
    <title>Payment Status</title>
    
    <style>
        .status-container {
            text-align: center;
            padding: 2rem;
        }

        .status-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .success {
            color: #28a745;
        }

        .pending {
            color: #ffc107;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="status-container">
        @if ($status == 'success')
            <div class="status-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Payment Successful!</h2>
            <p>Your order #{{ $orderId }} has been processed successfully.</p>
        @elseif($status == 'pending')
            <div class="status-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <h2>Payment Pending</h2>
            <p>Your order #{{ $orderId }} is waiting for payment confirmation.</p>
        @else
            <div class="status-icon error">
                <i class="fas fa-times-circle"></i>
            </div>
            <h2>Payment Failed</h2>
            <p>There was an error processing your order #{{ $orderId }}.</p>
        @endif

        <a href="/" class="btn btn-primary mt-3">Back to Home</a>
    </div>
</body>

</html>
