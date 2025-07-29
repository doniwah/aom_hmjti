<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/verifi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg  ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand text-white" href="/"><img src="/images/aom.png" width="100px"></a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>

                <div class="collapse navbar-collapse text-warning" id="ftco-nav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item "><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="/#GuestStar" class="nav-link">GuestStar</a></li>
                        <!--  -->
                        <li class="nav-item"><a href="/#ticket" class="nav-link">Ticket</a></li>
                        <li class="nav-item"><a href="{{ route('listticket') }}" class="nav-link">List Ticket</a></li>
                    </ul>

                    <ul class="navbar-nav mx-end">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">c
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="container main">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center m-1 "><strong>E-Ticket || Art Of Manunggalan 10.0</strong></p>
                        </div>
                        <img src="{{ asset('images/aom.png') }}" class="mx-auto d-block" width="250px" alt="AOM logo">
                        <div class="card-body">
                            <div class="container">
                                <label style="font-size: 12px;" id="tgl_transaksi"
                                    class="col-sm-4 col-5 col-form-label text-wrap">{{ $data->created_at }}</label>

                                <div class="row">
                                    <div class="form-group row font-weight-bold ">
                                        <label for="staticEmail"
                                            class="col-sm-4 col-5 col-form-label text-wrap">Username</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                {{ $data->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail" class="col-sm-4 col-5 col-form-label text-wrap">Kode
                                            Panitia</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                {{ $data->id_panitia }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail"
                                            class="col-sm-4 col-5 col-form-label text-wrap">Nama Ticket</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                {{ $data->ticket->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container text-black">
                                <hr>
                                <div class="row">
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail" class="col-sm-4 col-5 col-form-label text-wrap">Harga
                                            Ticket</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                Rp. @currency($data->ticket_price)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail" class="col-sm-4 col-5 col-form-label text-wrap">Biaya
                                            Admin</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                Rp. @currency($data->transaction_fee)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail"
                                            class="col-sm-4 col-5 col-form-label text-wrap">Diskon</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end font-weight-bold">
                                                Rp. @currency($data->voucher_discount)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row font-weight-bold">
                                        <label for="staticEmail"
                                            class="col-sm-4 col-5 col-form-label text-wrap fw-bold">Total Harga</label>
                                        <div class="col-sm-8 col-7">
                                            <p class="form-control-plaintext text-end fw-bold">
                                                Rp. @currency($data->total_prices)</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="form-group text-center">
                                @php
                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            @endphp
                            @if ($data->kode_barcode != null)
                            <img class="d-block mx-auto" width="200px"
                            height="30px"
                            src="data:image/png;base64,{{ base64_encode($generator->getBarcode($data->kode_barcode, $generator::TYPE_CODE_128)) }}"
                            alt="">
                            <p>{{$data->kode_barcode}}</p>

                            <br>
                            @endif
                               <div class="text-center">
                                    @if ($data->confirmation != 3)
                                        @if ($data->confirmation == 1)
                                            <p class="text-danger">Transaksi ditolak, Upload Ulang Bukti Transfer!</p>
                                        @endif
                                        @if (($data->confirmation == 0 && !$data->bukti_pembayaran) || $data->confirmation == 1 )
                                        <div class="row justify-content-center">
                                            <div class="col-auto text-center">
                                                <div id="timer" class="d-flex justify-content-center mb-3">
                                                    <div class="time mx-2">
                                                        <p id="hour" class="digit display-6 font-weight-bold">00</p>
                                                        <p class="digit_name font-weight-bold">Hours</p>
                                                    </div>
                                                    <div class="time mx-2">
                                                        <p id="min" class="digit display-6 font-weight-bold">00</p>
                                                        <p class="digit_name font-weight-bold">Minutes</p>
                                                    </div>
                                                    <div class="time mx-2">
                                                        <p id="sec" class="digit display-6 font-weight-bold">00</p>
                                                        <p class="digit_name font-weight-bold">Seconds</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @php
                                            $buttonText = !$data->bukti_pembayaran
                                                ? 'Bayar Sekarang'
                                                : ($data->confirmation == 1
                                                    ? 'Upload Ulang'
                                                    : 'Lihat Bukti');
                                        @endphp

                                        <button id="pay-btn" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#bayarTicket">
                                            {{ $buttonText }}
                                        </button>
                                        @if (Str::contains($data->ticket->sales_in, 'Bundle') && $data->confirmation == 2)

                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#kirimMultiEmail">
                                                Kirim Ticket
                                            </button>

                                            <div class="modal fade" id="kirimMultiEmail" tabindex="-1"
                                                aria-labelledby="kirimMultiEmail" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <form action="{{route('bundleEmail', $data->id_transaction)}}" method="post" id="formMultiEmail">
                                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                             <h1 class="modal-title fs-5">Kirim Ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group row text-dark">
                                                                        @php
                                                                            $numFields =
                                                                                count($bundleTicket) > 0
                                                                                    ? count($bundleTicket)
                                                                                    : (int) Str::before(
                                                                                        $data->ticket->name,
                                                                                        ' ',
                                                                                    );
                                                                        @endphp


                                                                        @for ($i = 0; $i < $numFields; $i++)
                                                                            <div class="col-sm-12 col-12 mb-2">
                                                                                <div class="form-group">
                                                                                    <div
                                                                                        class="input-group input-group-md">
                                                                                        <div
                                                                                            class="input-group-append mx-3">
                                                                                            <label>Email
                                                                                                {{ $i + 1 }}:
                                                                                            </label>
                                                                                        </div>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-md"
                                                                                            name="email_bundle[]"
                                                                                            placeholder="Email {{ $i + 1 }}"
                                                                                            {{ count($bundleTicket) > 0 ? "readonly" : "" }}
                                                                                            value="{{ $bundleTicket[$i]->email ?? '' }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endfor

                                                                    </div>
                                                                </div>

  <span class="text-danger">Ticket yang sudah dikirim, tidak dapat diubah. Silakan hubungi tim di +62 852-1670-9554 jika terdapat kesalahan dalam pengiriman email.</span>

                                                                <br>
                                                                <br>
                                                                @if (count($bundleTicket) == 0)
                                                                    <button type="submit"
                                                                        class="btn btn-primary text-right">Kirim</button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                </div>

                                                </form>
                                            </div>
                                </div>
                                @endif
                                    @else
                                        <p class="text-danger">Tiket telah hangus, Anda tidak dapat melanjutkan
                                            transaksi. Silakan buat transaksi baru!</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bayarTicket" tabindex="-1" aria-labelledby="bayarTicket" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="{{ route('uploadPembayaran', $data->id_transaction) }}" method="post" id="formTicket"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Upload Bukti</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (!$data->bukti_pembayaran)

                        @php
                         
                        $paymentMethods = [
                            'bca' => ['name' => 'Retasya Salsabila Putri', 'account' => '6025039037'],
                            'mandiri' => ['name' => 'Retasya Salsabila Putri', 'account' => '1430031618307'],
                        ];
                        @endphp
                        
                        @if (array_key_exists($data->payment_method, $paymentMethods))
                            @php
                                $payment = $paymentMethods[$data->payment_method];
                            @endphp
                            <h6>{{ strtoupper($data->payment_method) }}: (A/n <b>{{ $payment['name'] }}</b>)</h6>
                            <div class="row">
                                <div class="form-group row text-dark">
                                    <div class="col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-md">
                                                <input type="text" class="form-control form-control-md"
                                                    id="no_rekening" name="kode_panitia" value="{{ $payment['account'] }}"
                                                    readonly placeholder="NO REKENING">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger btn-md" type="button"
                                                        onclick="copyToClipboard();">Copy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h4> PAYMENT METHOD INVALID </h4>
                        @endif
                        <br>
                        @endif

                        <label for="staticEmail" class="col-12 col-form-label text-wrap">Bukti Pembayaran (<b>Max: 2MB</b>)</label>
                        <div class="col-12">
                            @if (!$data->bukti_pembayaran || $data->confirmation == 1)
                                <input type="file" class="form-control form-control-sm" name="bukti_pembayaran"
                                    onchange="previewImage(this);" readonly>
                            @endif
                            <img id="gambar-preview"
                                src="{{ $data->bukti_pembayaran ? url('imageslink/' . $data->bukti_pembayaran) : '#' }}"
                                alt="Gambar Pratinjau"
                                style="max-width: 50%; margin: 0 auto;margin-top:10px; display: {{ $data->bukti_pembayaran ? 'block' : 'none' }};">
                        </div>
                        <br>
                        @if (!$data->bukti_pembayaran  || $data->confirmation == 1)
                            <button type="submit" class="btn btn-primary text-right">Kirim</button>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
      var transaction_date = document.querySelector("#tgl_transaksi").innerHTML;
        var target_mili_sec = new Date(transaction_date);
        if({{$data->confirmation}} == 0){
            target_mili_sec.setHours(target_mili_sec.getHours() + 2);
        }else if({{$data->confirmation}} == 1)
        {
            target_mili_sec.setHours(target_mili_sec.getHours() + 24);
        }
        var target_date = target_mili_sec.getTime();
        function timer() {
            var now_mili_sec = new Date().getTime();
            var remaining_sec = Math.floor((target_date - now_mili_sec) / 1000);
             if (remaining_sec <= 0) {
                // If time is up, set all to 0
                document.querySelector("#hour").innerHTML = "0 : ";
                document.querySelector("#min").innerHTML = "0 : ";
                document.querySelector("#sec").innerHTML = "0";
                return; // Exit the function
            }
                        var day = Math.floor(remaining_sec / (3600 * 24));
            var hour = Math.floor((remaining_sec % (3600 * 24)) / 3600);
            var min = Math.floor((remaining_sec % 3600) / 60);
            var sec = Math.floor(remaining_sec % 60);

            document.querySelector("#hour").innerHTML = hour  + " : ";
            document.querySelector("#min").innerHTML = min  + " : ";
            document.querySelector("#sec").innerHTML = sec;
        }

        setInterval(timer, 1000);
        function copyToClipboard() {
            const textField = document.getElementById('no_rekening');
            textField.select();
            document.execCommand('copy');
            alert('Text copied to clipboard!');
        }

        function previewImage(input) {
            var preview = document.getElementById('gambar-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>
