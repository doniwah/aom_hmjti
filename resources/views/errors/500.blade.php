<!DOCTYPE html>
<html>

<head>
    <title>Server Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #d9534f;
        }
    </style>
</head>

<body>
    <h1>500 - Server Error</h1>
    <p>Sorry, something went wrong. Our team has been notified.</p>
    <a href="/">Return to Home</a>

    @if (env('APP_DEBUG') && isset($errorMessage))
        <div style="margin-top: 20px; color: #777;">
            {{ $errorMessage }}
        </div>
    @endif
</body>

</html>
