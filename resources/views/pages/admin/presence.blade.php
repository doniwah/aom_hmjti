@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Presence')

@section('content')
    @push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endpush
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Kehadiran
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Scan Kehadiran</h3>
            </div>
            <div class="block-content block-content-full overflow-x-auto shadow">
                <form id="data-form">
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">Barcode</label>
                        <div class="col-sm-10">
                            <input tabindex="1" type="text" class="form-control" name="code" id="code"
                                placeholder="Masukan Barcode Pengguna" autocomplete="off" autofocus="true"
                                onkeyup="if(this.value.length >= 10) {getdatauser($('#data-form'))}"
                                onfocus="this.form.reset()">
                        </div>
                    </div>
                    <div class="m-2">
                        <div class="form-group row">
                            <div class="form-check form-switch">
                                <input class="form-check-input" onclick="checkinput()" type="checkbox" value=""
                                    id="check" name="check">
                                <label class="form-check-label fs-sm" for="check">Aktifkan Apabila Akan Mencari Tiket
                                    Berdasarkan Email Pengguna</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-2">
                        <label for="code" class="col-sm-2 col-form-label">Email</label>
                        <input type="email" disabled class="form-control rounded" id="email" name="email"
                            placeholder="Masukan Email Pengguna">
                        <button type="button" disabled id="btnemail" onclick="getdatauser($('#data-form'))"
                            class="btn btn-alt-primary">
                            <i class="fa fa-search me-1 opacity-50"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modallihatdata" tabindex="-1" role="dialog" aria-labelledby="modallihatdata"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ticket</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <label for=""><b>ID Transaksi : <b id="IDTransaksi"></b></b></label>
                                   
                                    <label for=""><b>Nama Penonton : <b id="NamaPenonton"></b></b></label>
                                    <label for=""><b>Email Penonton : <b id="EmailPenonton"></b></b></label>
                                   
                                    <label for="" class="mt-1"><b>Status Kehadiran : <b id="status_kehadiran"></b>
                                        </b></label>
                                    <label for=""><b>Jenis Ticket : <b id="JenisTicket"></b></b></label>
                                    <label for=""><b>Barcode : </b></label>
                                    <div class="text-center">
                                        <img class="img-fluid w-100" src="" id="barcode" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <img src="http://127.0.0.1:8000/img/payment/6672d81d5aa2a.jpg" class="img-fluid"
                                    height="50px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalConfirmPresence">Konfirmasi Kehadiran</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirmPresence" tabindex="-1" role="dialog"
        aria-labelledby="modalConfirmPresence" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ticket</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.presence.presenced') }}">
                        @csrf
                        @method('POST')
                        <div class="block-content fs-sm">
                            <input readonly id="codetransaksi" type="hidden" hidden name="code" value="">
                            <b>apakah anda ingin menggunakan tiket ini ?</b>
                            <p class="text-danger">Apabila melakukan konfirmasi, penonton dianggap telah menghadiri acara
                                dan tiket tidak dapat digunakan kembali.</p>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-target="#modallihatdata" data-bs-toggle="modal">Kembali</button>
                            <button type="submit" tabindex="1" class="btn btn-primary">Gunakan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkinput() {
            const radiocheck = document.getElementById("check");
            const emailinpt = document.getElementById("email");
            const emailbtn = document.getElementById("btnemail");
            const barcodeinpt = document.getElementById("code");
            if (radiocheck.checked) {
                //inp email aktif
                emailinpt.disabled = false;
                // emailinpt.focus();
                emailbtn.disabled = false;
                barcodeinpt.disabled = true;
                barcodeinpt.value = null;
            } else {
                //inp code aktif
                emailinpt.disabled = true;
                emailbtn.disabled = true;
                emailinpt.value = null;
                barcodeinpt.disabled = false;
                barcodeinpt.focus();
            }
        }

        function getdatauser(form) {
            const formData = form.serialize();
            const inpcode = document.getElementById('code');
            $.ajax({
                url: '{{ route('admin.presence.userdata') }}',
                type: 'GET',
                data: formData,
                dataType: 'json',
                success: function(val) {
                    if ($.isEmptyObject(val)) {
                        alert('Tiket Pengguna Tidak Ditemukan,Coba Scan Ulang Atau Cari Menggunakan email',
                            'error');
                        $(inpcode).val(null);
                    } else {
                        setvaluemodal(val);
                        // myModal.show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors here (optional)
                    console.error('Error submitting data:', textStatus, errorThrown);
                }
            });
        }

        function setvaluemodal(val) {
            const IDTransaksi = document.getElementById('IDTransaksi');
            const codetransaksi = document.getElementById('codetransaksi');
            const inpcode = document.getElementById('code');
            const JenisTicket = document.getElementById('JenisTicket');
            // const MetodePembayaran = document.getElementById('MetodePembayaran');
            const NamaPenonton = document.getElementById('NamaPenonton');
            const email = document.getElementById('email');
            const EmailPenonton = document.getElementById('EmailPenonton');
            // const NomorTelepon = document.getElementById('NomorTelepon');
            // const status_konfirmasi = document.getElementById('status_konfirmasi');
            const status_kehadiran = document.getElementById('status_kehadiran');
            const barcode = document.getElementById('barcode');
            const barcodetext = document.getElementById('barcodetext');
            const myModal = new bootstrap.Modal(document.getElementById("modallihatdata"), {});

            if (val.presence != 1) {
                $(IDTransaksi).html(val.id_transaction);
                $(codetransaksi).val(val.kode_barcode);
                $(JenisTicket).html(val.nama_ticket);
                // $(MetodePembayaran).html(val.payment_method);
                $(NamaPenonton).html(val.nama_lengkap);
                $(EmailPenonton).html(val.email);
                // $(NomorTelepon).html(val.user.telp);
                // $(status_konfirmasi).html(val.confirmation);
                // if (val.confirmation == 2) {
                //     $(status_konfirmasi).html(
                //         '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light ">Sudah Di Verifikasi</span>'
                //     );
                // } else {
                //     $(status_konfirmasi).html(
                //         '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Belum Di Verifikasi</span>'
                //     );
                // }
                if (val.presence == 1) {
                    $(status_kehadiran).html(
                        '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light ">Sudah Diambil</span>'
                    );
                } else {
                    $(status_kehadiran).html(
                        '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Belum Diambil</span>'
                    );
                }

                JsBarcode("#barcode", val.kode_barcode, {
                    format: "CODE128",
                    lineColor: "#000",
                    width: 5,
                    height: 80,
                    fontSize: 30,
                    displayValue: true
                });
                myModal.show()
            } else {
                $(inpcode).val(null);
                $(email).val(null);
                alert("gagal mengkonfirmasi tiket dikarenakan telah dikonfirmasi", "error");
            }

        }

        function alert(message, type) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                width: '32rem',
                timerProgressBar: true,
            });
            Toast.fire({
                icon: type,
                title: message
            });
        }
    </script>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
    @push('script')
        <script src="{{ asset('dashboard_assets/js/lib/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    @endpush
@endsection
