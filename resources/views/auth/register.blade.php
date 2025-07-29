<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="images/aom.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
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
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="input-field">
                                <input type="text" class="input" id="username" required name="username"
                                    value="{{ old('username') }}" autocomplete="off" autofocus>
                                <label for="username">Username</label>

                            </div>
                            <div class="input-field">
                                <input type="text" class="input" id="email" name="email"
                                    value="{{ old('email') }}" required autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="input" name="password" value="{{ old('password') }}"
                                    id="pass" required>
                                <label for="pass">Password</label>
                                <small id="password-error" style="color: red;"></small>
                                @if ($errors->has('password'))
                                    <small id="password-error"
                                        style="color: red;">{{ $errors->first('password') }}</small>
                                    <script>
                                        setTimeout(function() {
                                            document.getElementById("password-error").style.display = "none";
                                        }, 2000); // 2000ms = 2 seconds
                                    </script>
                                @endif
                            </div>

                            <div class="input-field">
                                <input type="password" name="confirm_password" class="input"
                                    value="{{ old('confirm_password') }}" id="pass" required>
                                <label for="pass">Confirm Password</label>
                                <small id="password-error" style="color: red;"></small>
                                @if ($errors->has('password'))
                                    <small id="password-error"
                                        style="color: red;">{{ $errors->first('password') }}</small>
                                    <script>
                                        setTimeout(function() {
                                            document.getElementById("password-error").style.display = "none";
                                        }, 2000); // 2000ms = 2 seconds
                                    </script>
                                @endif
                            </div>

                            <div class="input-field">
                                <input type="submit" class="btn btn-light" value="Sign Up">
                                {{-- <button type="submit" class="submit" value="Sign Up"> --}}
                            </div>
                        </form>
                        <div class="backto mt-5">
                            <span>Already have an account? <a href="{{ route('login') }}">Log in here</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('pass');
        const passwordErrorElement = document.getElementById('password-error');

        form.addEventListener('submit', function(event) {
            if (passwordInput.value.length < 8) {
                event.preventDefault();
                passwordErrorElement.textContent = 'Password harus minimal 8 karakter';
                setTimeout(function() {
                    passwordErrorElement.textContent = '';
                }, 2000); // hide the error message after 2 seconds

            }
        });
    </script>
</body>

</html>
