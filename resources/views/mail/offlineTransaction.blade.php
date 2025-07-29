{{-- @component('mail::message')
{{ $data['name'] }}

{{ $data['message'] }}

@component('mail::button', ['url' => $data['url']])
{{ $data['button'] }}
@endcomponent

@endcomponent --}}
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">

    <!-- Web Font / @font-face : BEGIN -->
    <!--[if mso]>
        <style>
            * {
                font-family: 'Roboto', sans-serif !important;
            }
        </style>
    <![endif]-->

    <!--[if !mso]>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    
    
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color:#8094ae;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        a {
            text-decoration: none;
        }
        .barcode128 {
          font-family: "Libre Barcode 128", system-ui;
          font-weight: 400;
          font-size: 40px;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
    </style>

</head>
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
	<center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
            <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding-bottom:25px">
                                    <a href="#"><img style="height: 70px" src="{{ asset('img/logo aom.png') }}" alt="logo"></a>
                                    {{-- <p style="font-size: 30px; color: #FFC03A; padding-top: 12px;">ART OF MANUNGGALAN 10 2024</p> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding: 15px 30px;">
                                    <img style="width:88px; margin-bottom:24px;" src="{{ asset($data['img']) }}" alt="Verified">
                                    <h2 style="font-size: 18px; color: {{ $data['color'] }}; font-weight: 400; margin-bottom: 8px;">Pembelian Tiket Art Of Manunggalan 10 {{ $data['text'] }}.</h2>
                                    {{-- <img style="width:88px; margin-bottom:24px;" src="{{ asset('img/ticket_mail/berhasil.png') }}" alt="Verified">
                                    <h2 style="font-size: 18px; color: #1ee0ac; font-weight: 400; margin-bottom: 8px;">Pembayaran Tiket Berhasil Di Verifikasi.</h2> --}}
                                    <p>{{ $data['text2'] }}</p>
                                </td>
                            </tr>
                            <tr>
                                <h1 style="font-size:24px; font-weight:700; text-align:center; color: {{ $data['nama_ticket'] == 'Gold' ? 'gold' : 'black' }}; margin:10px;">{{$data["nama_ticket"]}}</h1>
                            </tr>
                            <tr>
                                <td style="text-align:center;padding: 0 30px 20px">
                                    <p style="margin-bottom: 25px;"><b>{{ $data['text3'] }}</b></p>
                                    {{-- <a href="#" style="background-color:#fca311;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 25px">Reset Password</a> --}}
                                     
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © 2024 HMJTI. All rights reserved.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </center>
</body>
</html>