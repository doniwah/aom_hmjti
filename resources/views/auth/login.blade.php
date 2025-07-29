<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="images/aom_maskot.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                </div>

                <div class="col-md-6 right">

                    <div class="input-box">

                        <header><img src="images/text_aom11.png" alt="" class="teks-top"></header>
                        @if (session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mx-auto text-xs p-2"
                                role="alert" id="error-alert">
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('error-alert').classList.remove('show');
                                    document.getElementById('error-alert').classList.add('hide');
                                    // Reset styles and classes to original state
                                    document.getElementById('error-alert').style.display = 'none';
                                    document.getElementById('error-alert').classList.remove('alert-danger');
                                    document.getElementById('error-alert').classList.remove('alert-dismissible');
                                    document.getElementById('error-alert').classList.remove('fade');
                                }, 2000);
                            </script>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-field">
                                <span class="input-icon email"></span>
                                <input type="email" class="input @error('name') is-invalid @enderror" id="name"
                                    name="email" required="" autocomplete="off">
                                <label for="name">Email</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field">
                                <span class="input-icon password"></span>
                                <input type="password" class="input @error('password') is-invalid @enderror"
                                    id="pass" name="password" required="">
                                <span class="eye-icon" onclick="togglePassword()" id="eyeIcon"></span>
                                <label for="pass">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="forgot">
                                <span>
                                    Lupa kata sandi?<a class="" href="{{ route('password.request') }}">
                                        Klik disini
                                    </a>
                                </span>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" value="Login">
                            </div>
                            <div class="signin">
                                <span>Don't have an account? <a href="{{ route('register') }}">Sign Up here</a></span>
                            </div>
                            <div class="backto pb-lg-5">
                                <span>Back to<a href="{{ route('home') }}"> Home</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('pass');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hide');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hide');
            }
        }
    </script>
</body>

</html>
