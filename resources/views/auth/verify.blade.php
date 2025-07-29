
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="icon" href="{{asset('images/aom.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reset Password</title>
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                </div>

                <div class="col-md-6 right">

                    <div class="input-box">

                        <header>Welcome Back to <span class="text-danger">AOM</span></header>
                        <h6>Verifikasi your email</h6>
                        <p>Before proceeding to purchase tickets, please check your email for the verification link. If you do not receive the verification email</p>
                       <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-3 align-baseline">{{ __('click here to request another') }}</button>
                        <!-- <div class="signin">
                                <span>Don't have an account? <a href="{{ route('password.request') }}">Verify</a></span>
                            </div> -->
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>