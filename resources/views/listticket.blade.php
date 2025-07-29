<!DOCTYPE html>
<html lang="en">

<head>
    <title>AOM 10.0</title>
    <link rel="stylesheet" href="">
    <link rel="icon" href="images/aom.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg  ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand text-white" href="/"><img src="images/aom.png" width="100px"></a>
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
                                <li class="nav-item">
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
    <!-- END nav -->

   <section class="ftco-section" id="ticket">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated">TICKET</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span class="id-color"></span>
                            TICKET</h2>
                        <div class="small-border bg-color-2"></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    LIST YOUR TICKET</div>
                            </div>
                            <div class="col-auto">
                                <a type="button" href="/#ticket" class="btn btn-primary btn-sm">Add Ticket</a>
                            </div>

                            <div class="card m-2">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kategori Ticket</th>
                                                    <th>Status</th>
                                                    <th>Purchase Date</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                               
                                            </thead>
                                            <tbody>
                                                 @foreach($data as $dat)
                                                 <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$dat->ticket->name}}</td>
                                                    <td>
                                                        @if($dat->confirmation == 0)
                                                        <span class="badge text-bg-warning">pending</span>
                                                        @elseif($dat->confirmation == 1)
                                                        <span class="badge text-bg-danger">Ditolak</span>
                                                         @elseif($dat->confirmation == 2)
                                                        <span class="badge text-bg-success">Dikonfirmasi</span>
                                                        @elseif($dat->confirmation == 3)
                                                        <span class="badge text-bg-danger">Hangus</span>
                                                        @else 
                                                         <span class="badge text-bg-info">Load...</span>
                                                        @endif
                                                        </td>
                                                    <td>{{ $dat->created_at->format('d/m/Y') }}</td>
                                                    <td>{{$dat->no_telp}}</td>
                                                    <td><a href="{{route('verifikasiPembayaran',$dat->id_transaction)}}" class="btn btn-primary btn-sm">Detail</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <footer id="footer">
        <div class="footer-top pt-5">
            <div class="container">
                <img src="images/logo.png" width="300px" class="img-fluid mr-3">
                <img src="images/aom.png" width="100px" class="img-fluid">

                <div class="row mt-3">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-info">
                            <div>
                                <iframe style="border:0; width: 100%; height: 270px;"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.4475411397284!2d113.72020707434469!3d-8.15758328172425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b6ea0e8375%3A0x4618d7137a4cf5c1!2sGedung%20Jurusan%20TI%20Politeknik%20Negeri%20Jember!5e0!3m2!1sid!2ssg!4v1685635062443!5m2!1sid!2ssg"
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                            <p class="text-white">Gd. Teknologi Informasi, Politeknik Negeri Jember, Lingkungan Panji,
                                Tegalgede,<br>
                                Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68124<br>
                            </p>
                            <div class="social-links">
                                <a href="mailto:hmjti@polije.ac.id" class="email"><i
                                        class="fa-solid fa-envelope"></i></a>
                                <a href="https://www.instagram.com/aom.jti/" class="instagram"><i
                                        class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4 class="text-white">Halaman</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#" class="text-white">Beranda</a>
                            </li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links text-white">
                        <h4 class="text-white">Pranala</h4>
                        <ul class="text-white">
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.polije.ac.id"
                                    class="text-white">Politeknik Negeri
                                    Jember</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.jti.polije.ac.id"
                                    class="text-white">Jurusan Teknologi
                                    Informasi POLIJE</a></li>
                            
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.hmjtipolije.com"
                                    class="text-white">Himpunan Mahasiswa
                                    Jurusan Teknologi Informasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-container">
            <div class="copyright">
                &copy; 2024 Art of Manunggalan 10.0
            </div>
            <div class="credits">
                Dikembangkan Oleh <a href="#">Biro
                    Pengembangan Sistem Informasi, Departemen Keilmuan</a>
            </div>
        </div>
        </div>
    </footer>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Biro Pengembangan Sistem Informasi</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>





    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    <script>
        $(document).ready(function() {
            let totalHSBA = 0;
            let potonganAdmin = 0;
            let biayaAdmin = 0;
            let hargaTiket = 0;
            $("#payment_method").prop("selectedIndex", 0);
            const formatNumber = new Intl.NumberFormat("id-ID", {
                style: 'currency',
                currency: 'IDR'
            });

            // Utility functions
            function parseCurrency(currencyString) {
                return parseFloat(currencyString.replace(/Rp\s*/, '').replace(/\./g, '').replace(/,/g, '.'));
            }

            function parseFormattedNumber(formattedNumber) {
                return parseInt(formattedNumber.replace(/\./g, ''), 10);
            }

            function updateText(selector, value) {
                $(selector).text(formatNumber.format(value));
            }

            function handleAjaxError(jqXHR, textStatus, errorThrown) {}

            // Initial setup
            updateText("#biayaAdmin", 0);
            updateText("#hargaDiskon", 0);

            // Event handlers
            $("#submitPanitia").click(function() {
                const idPanitia = $("#kode_panitia").val();
                $.get(`getPanitia/${idPanitia}`)
                    .done(function(item) {
                        if (item.data) {
                            $("#kode_panitia").prop('readonly', true);
                            $("#submitPanitia").hide();
                            alert("Berhasil");
                        } else {
                            alert("Kode Tidak Ditemukan");
                        }
                    })
                    .fail(handleAjaxError);
            });

            $("#submitVoucher").click(calcVoucher);

            $("#payment-method").change(function() {
                const idMethod = $(this).val();
                const methodToAdmin = {
                    "bri": 2500,
                    "bca": 2500,
                    "mandiri": 2500,
                };

                if (methodToAdmin.hasOwnProperty(idMethod)) {
                    potonganAdmin = methodToAdmin[idMethod];
                    calcBiayaAdmin(potonganAdmin);
                } else {
                    alert("Terjadi kesalahan");
                }
            });

            $(".btnModal").click(function() {
                const $pricingS1 = $(this).closest('.pricing-s1');
                const ticketName = $pricingS1.find(".ticket-name").text().trim();
                hargaTiket = parseFormattedNumber($pricingS1.find(".hargaTiket").text().trim());

                $("#ticketName").val(ticketName).prop('readonly', true);
                updateText("#hargaNormal", hargaTiket);
                updateText("#totalHarga", hargaTiket);
            });

            $('#modalTiket').on('hidden.bs.modal', function() {
                $('#formTicket')[0].reset();
            });

            function calcBiayaAdmin(potonganAdmin) {
                biayaAdmin = potonganAdmin < 1 ? hargaTiket * potonganAdmin : potonganAdmin;
                totalHSBA = hargaTiket + biayaAdmin;
                calcVoucher();
                updateText("#biayaAdmin", biayaAdmin);
                updateText("#totalHarga", totalHSBA);
            }

            function calcVoucher() {
                const idVoucher = $("#kode_voucher").val();
                $.get(`getVoucher/${idVoucher}`)
                    .done(function(item) {
                        if (item.data) {
                            const hargaDiskon = item.data.discount;
                            let totalHarga = totalHSBA - hargaDiskon;
                            if (totalHarga < 1) totalHarga = hargaTiket - hargaDiskon;

                            if (totalHarga >= 10000) {
                                $("#kode_voucher").prop('readonly', true);
                                updateText("#hargaDiskon", hargaDiskon);
                                updateText("#totalHarga", totalHarga);
                                $("#submitVoucher").hide();
                            } else {
                                alert("Kode Voucher Tidak Dapat Dipakai");
                                $("#kode_voucher").val("");
                            }
                        } else {
                            alert("Kode Voucher Tidak Valid");
                            $("#kode_voucher").val("");
                        }
                    })
                    .fail(handleAjaxError);
            }
        });
    </script>
</body>

</html>
