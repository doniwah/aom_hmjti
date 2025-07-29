<!DOCTYPE html>
<html lang="en">

<head>
    <title>AOM 11.0</title>
    <link rel="stylesheet" href="">
    <link rel="icon" href="images/aom_maskot.png">
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
                <a class="navbar-brand text-white" href="/"><img src="images/aom_maskot.png" width="100px"></a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>

                <div class="collapse navbar-collapse text-warning " id="ftco-nav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item "><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#GuestStar" class="nav-link">GuestStar</a></li>
                        <!--  -->
                        <li class="nav-item"><a href="#ticket" class="nav-link">Ticket</a></li>
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

    <div class="hero-wrap js-fullheight">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-6 col-sm-12 left-section d-flex align-items-center">
                    <div class="content-wrapper">
                        <div class="title-section mb-4">
                            <img class="judul_hero" src="/images/hero_aom11.png" alt="">
                            <img class="teks_hero" src="/images/hero_teks.png" alt="">
                        </div>

                        <div id="timer" class="timer-wrapper mb-4">
                            <div class="time-box">
                                <p id="day" class="digit">00</p>
                                <p class="digit_name">Days</p>
                            </div>
                            <div class="time-box">
                                <p id="hour" class="digit">00</p>
                                <p class="digit_name">Hours</p>
                            </div>
                            <div class="time-box">
                                <p id="min" class="digit">00</p>
                                <p class="digit_name">Minutes</p>
                            </div>
                            <div class="time-box">
                                <p id="sec" class="digit">00</p>
                                <p class="digit_name">Seconds</p>
                            </div>
                        </div>

                        <button class="btn-ticket">Buy Ticket Now</button>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-md-6 col-sm-12 right-section">
                    <div class="venue-image-wrapper">
                        <div class="venue-card">
                            <img src="{{ asset('images/docum_0.png') }}" alt="Venue" class="venue-image">
                            <div class="venue-overlay">
                                <div class="venue-dots">
                                    <span class="dot active"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="ftco-section-guest" id="GuestStar">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated ">GUESTSTAR</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span class="id-color"></span>
                            GUESTSTAR</h2>
                        <div class="small-border bg-color-2"></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="speaker">
                                <div class="image-container">
                                    <img src="images/WebFiersa.png" class="img-fluid" alt="Colorlib HTML5 Template">
                                    <div class="text-overlay">
                                        <h3>Fiersa Besari</h3>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="speaker">
                                <div class="image-container">
                                    <img src="images/WebUpcoustic.png" class="img-fluid"
                                        alt="Colorlib HTML5 Template">
                                    <div class="text-overlay">
                                        <h3>UpCoustic</h3>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="speaker">
                                <div class="image-container">
                                    <img src="images/WebSunday.png" class="img-fluid" alt="Colorlib HTML5 Template">
                                    <div class="text-overlay">
                                        <h3>Sunday Groove </h3>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="item">
                            <div class="speaker">
                                <div class="image-container">
                                    <img src="images/WebIksan.png" class="img-fluid" alt="Colorlib HTML5 Template">
                                    <div class="text-overlay">
                                        <h3>Iksan Skuter</h3>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" id="playlist">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated">PLAYLIST</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span class="id-color"></span>
                            PLAYLIST</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate text-center">
                    <iframe style="border-radius:12px"
                        src="https://open.spotify.com/embed/playlist/3K3JK8CAbcv1nHTwFb2Jku?utm_source=generator"
                        width="100%" height="352" frameBorder="0" allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" id="stage">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated">STAGE</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span class="id-color"></span>
                            STAGE</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate text-center">
                    <img src="{{ asset('images\stage-glow.png') }}" class="img-fluid wow fadeInUp"
                        style="border-radius: 20px" width="70%">
                </div>
            </div>
        </div>
    </section>

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
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-testimony owl-carousel">
                        @foreach ($ticket as $item)
                            @if ($item->quantity > 0)
                                <div class="pricing-s1 mb-sm-30 wow flipInY">
                                    <div class="top text-center">
                                        <h2 class="ticket-name">{{ $item->name }}</h2>
                                    </div>
                                    <div class="mid text-center bg-c    olor-secondary text-light">
                                        <p class="price">
                                            <span class="currency">Rp</span>
                                            <span class="m opt-1 hargaTiket">@currency($item->price)</span>
                                        </p>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            @foreach ($item->ticket_benefit as $benefit)
                                                <li><i class="fa-solid fa-check mr-3"></i></i>{{ $benefit->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="action text-center">
                                        @guest
                                            <a type="button" href="{{ route('login') }}" class="btn btn-danger"
                                                style="border-radius: 40px;">
                                                Buy Ticket
                                            </a>
                                        @else
                                            <button class="btn btn-danger btnModal" style="border-radius: 40px;"
                                                data-bs-toggle="modal" data-bs-target="#beliTicket">
                                                Buy Ticket
                                            </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated">POST</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span class="id-color"></span> POST
                        </h2>
                        <div class="small-border bg-color-2"></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>
            </div>
            <div class="row g-custom-x carousel-testimony owl-carousel">
                @foreach ($postingans as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="post mb-sm-30 wow flipInY">
                            <blockquote class="instagram-media" data-instgrm-permalink="{{ $item->permalink }}"
                                data-instgrm-version="14"
                                style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; max-height:465px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                                <div style="padding:16px;"> <a
                                        href="https://www.instagram.com/p/C8ogbN3M7a6/?utm_source=ig_embed&amp;utm_campaign=loading"
                                        style=" d; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                        target="_blank">
                                        <div style=" display: flex; flex-direction: row; align-items: center;">
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                                </div>
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding: 19% 0;"></div>
                                        <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg
                                                width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                                xmlns="https://www.w3.org/2000/svg"
                                                xmlns:xlink="https://www.w3.org/1999/xlink">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                        <g>
                                                            <path
                                                                d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div style="padding-top: 8px;">
                                            <div
                                                style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                                View this post on Instagram</div>
                                        </div>
                                        <div style="padding: 12.5% 0;"></div>
                                        <div
                                            style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                            <div>
                                                <div
                                                    style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                                </div>
                                                <div
                                                    style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                                </div>
                                                <div
                                                    style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                                </div>
                                            </div>
                                            <div style="margin-left: 8px;">
                                                <div
                                                    style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                                </div>
                                                <div
                                                    style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                                </div>
                                            </div>
                                            <div style="margin-left: auto;">
                                                <div
                                                    style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                                </div>
                                                <div
                                                    style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                                </div>
                                                <div
                                                    style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                            <div
                                                style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                            </div>
                                            <div
                                                style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                            </div>
                                        </div>
                                    </a>
                                    <p
                                        style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                        <a href="https://www.instagram.com/p/C8ogbN3M7a6/?utm_source=ig_embed&amp;utm_campaign=loading"
                                            style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                            target="_blank">A post shared by Art of Manunggalan (@aom.jti)</a>
                                    </p>
                                </div>
                            </blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <div class="text-center">
                        <div class="wm wow slideInUp animated">SPONSORED</div>
                        <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span
                                class="id-color"></span>SPONSORED</h2>
                        <div class="small-border bg-color-2"></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>
            </div>
            <!--@foreach ($dataSponsor->slice(0, 3) as $data)
-->

            <!--            <img class="p-4" height="150" src="{{ asset('imageslink/' . $data->logo) }}" alt=""-->
            <!--                data-aos="zoom-in" data-aos-delay="100">-->
            <!--
@endforeach-->
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <strong>Open Sponsorship</strong>
                </div>
                <div class="card-body bg-secondary">
                    <h5 class="card-title text-white">Call the number below.</h5>
                    <p class="card-text text-white">Tiara : +62 881-0364-57089</p>
                    <form action="{{ route('contactSponsor') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Click to the WhatsApp</button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <section class="ftco-section">
        <div class="parallax-img d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <div class="text-center">
                            <div class="wm wow slideInUp animated">MEDPART</div>
                            <h2 class="wow fadeInUp text-white" data-wow-delay=".2s"><span
                                    class="id-color"></span>MEDPART</h2>
                            <div class="small-border bg-color-2"></div>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-header bg-dark text-white">
                        <strong>Open Media Partner</strong>
                    </div>
                    <div class="card-body bg-secondary">
                        <h5 class="card-title text-white">Call the number below.</h5>
                        <p class="card-text text-white">Evi : +62 812-1712-6005</p>
                        <form action="{{ route('contactMedpart') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success">Click to the WhatsApp</button>
                        </form>
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

    @if (Auth::check())
        <div class="modal fade" id="beliTicket" tabindex="-1" aria-labelledby="beliTicket" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form id="formTicket" method="post" action="{{ route('buy.ticket') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Buy Your Ticket</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <b><span class="text-danger">*: WAJIB DIISI</span></b>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Transaction</h5>
                                    <div class="row">
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Username <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8 col-7">
                                                <p class="form-control-plaintext text-end">
                                                    @if (Auth::check())
                                                        {{ Auth::user()->name }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">No
                                                HP <span class="text-danger">*</span></label>
                                            <div class="col-sm-8 col-7">
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="no_telp" minlength="10" maxlength="14"
                                                            placeholder="Masukan Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Nama
                                                Ticket <span class="text-danger">*</span></label>
                                            <div class="col-sm-8 col-7">
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="ticketName" name="nama_ticket"
                                                            placeholder="Enter Code">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Kode
                                                Panitia</label>
                                            <div class="col-sm-8 col-7">
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="kode_panitia" name="kode_panitia"
                                                            placeholder="Enter Code">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger btn-sm" type="button"
                                                                id="submitPanitia">Apply</button>
                                                        </div>
                                                    </div>
                                                    <span id="hasilPanitia"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="card-text text-dark" for="kode_voucher">
                                            Kode Voucher :
                                        </label>
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            name="kode_voucher" id="kode_voucher">
                                        <button class="btn btn-danger" type="button"
                                            id="submitVoucher">Apply</button>
                                    </div>
                                </div>
                                <span id="hasilVoucher"></span>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <strong class="card-text text-dark">
                                        Rincian Pembayaran
                                    </strong>
                                    <div class="row">
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Harga
                                                normal</label>
                                            <div class="col-sm-8 col-7">
                                                <p class="form-control-plaintext text-end" id="hargaNormal"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Biaya
                                                Admin</label>
                                            <div class="col-sm-8 col-7">
                                                <p class="form-control-plaintext text-end" id="biayaAdmin"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Harga
                                                Diskon</label>
                                            <div class="col-sm-8 col-7">
                                                <p class="form-control-plaintext text-end" id="hargaDiskon"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row text-dark">
                                            <label for="staticEmail"
                                                class="col-sm-4 col-5 col-form-label text-wrap">Total
                                                Harga</label>
                                            <div class="col-sm-8 col-7">
                                                <p class="form-control-plaintext text-end" id="totalHarga"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="border-radius: 40px;"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" style="border-radius: 40px;">Buat
                                Pesanan</button>
                        </div>
                    </div>
                    <input type="hidden" name="totalHarga" id="totalHargaInput">
                </form>
            </div>
        </div>
    @endif

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

            updateText("#biayaAdmin", 0);
            updateText("#hargaDiskon", 0);

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
                    "bca": 0,
                    "mandiri": 0,
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

            $('#formTicket').submit(function(e) {
                e.preventDefault();

                // Ambil nilai total harga dengan cara yang lebih akurat
                const totalHargaText = $('#totalHarga').text().trim();

                // Bersihkan format currency (untuk format "Rp 60.000,00")
                const totalHarga = parseFloat(
                    totalHargaText
                    .replace(/Rp\s?/g, '')
                    .replace(/\./g, '')
                    .replace(/,/g, '.')
                );

                console.log('Total Harga (Cleaned):', totalHarga); // Harusnya 60000

                // Validasi
                if (isNaN(totalHarga) || totalHarga < 10000) {
                    alert('Harga tidak valid!');
                    return;
                }

                // Set nilai ke hidden input
                $('#totalHargaInput').val(totalHarga);

                // Lanjutkan dengan AJAX submit
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success && response.snapToken) {
                            window.location.href = '/payment?snap_token=' + response.snapToken;
                        } else {
                            alert('Error: ' + (response.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Server error'));
                    }
                });
            });
        });
    </script>
</body>

</html>
