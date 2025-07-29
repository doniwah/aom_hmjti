<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>

<body>
    <button id="pay-button">Pay Now</button>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('payment.success') }}?order_id=" + result.order_id;
                },
                onPending: function(result) {
                    window.location.href = "{{ route('payment.pending') }}?order_id=" + result.order_id;
                },
                onError: function(result) {
                    window.location.href = "{{ route('payment.error') }}?order_id=" + result.order_id;
                }
            });
        });

        // Auto-trigger the payment popup when page loads
        window.onload = function() {
            document.getElementById('pay-button').click();
        };
    </script>
</body>

</html>
