<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="images/aom.png">
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

                        <header>Welcome Back to <span class="text-danger">AOM</span></header>
                        <p style="color: #B3B3B3">We will send a link to your email,use that link to reset password</p>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show mx-auto text-xs p-2"
                                role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.querySelector('.alert').classList.remove('show');
                                    document.querySelector('.alert').classList.add('hide');
                                    document.querySelector('.alert').style.display = 'none';
                                }, 3000); // Pesan akan hilang setelah 3 detik
                            </script>
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
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="input-field">
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
                                <input type="submit" class="submit" value="Send Password">
                            </div>
                            <div class="backto pb-lg-5">
                                <span>Back to<a href="{{ route('login') }}"> Login</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
