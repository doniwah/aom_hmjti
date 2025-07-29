@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Offline Ticketing')

@section('content')
    @push('style')
    @include('sweetalert::alert')
    @endpush
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Data Offline Ticketing
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="col-6 block block-rounded">
            <div class="block-content tab-content block-content-full overflow-x-auto">
                <h3 class="block-title">Form</h3>
                <form action="{{ route('store.ticketing') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukan Nama Lengkap"
                            name="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="Link" class="form-label">Email</label>
                        <input type="text" class="form-control" id="link" placeholder="Masukan Email"
                            name="email">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Nama Tiket</label>
                        <select name="nama_ticket" class="form-control">
                            <option hidden>-- Pilih Ticket --</option>
                            <option>Gold</option>
                            <option>Silver</option>
                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="status" class="form-label">Tempat Penjualan</label>
                       <input type="text" class="form-control" id="link" placeholder="Masukan Tempat (alun-alun, kopibos, ..)"
                            name="tempat_penjualan">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-primary" value="Tambahkan">
                    </div>
                </form>
            </div>
        </div>
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">

            <div class="block-content tab-content block-content-full overflow-x-auto">
                <h3 class="block-title">Table Ticketing</h3>
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">No</th>
                            <th style="width: 20%;">nama</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Email</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Ticket</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Kode</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Tempat</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Tanggal Pembelian</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $item)
                            <tr>
                                <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                <td class="fw-semibold fs-sm">{{ $item->nama_lengkap }}</td>
                                <td class="fw-semibold fs-sm">{{ $item->email }}</td>
                                <td class="d-none d-sm-table-cell">{{ $item->nama_ticket }}</td>
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                @endphp
                                <td class="d-none d-sm-table-cell">
                                    @if ($item->kode_barcode != null)
                                        <img class="d-block mx-auto" width="200px"
                                            src="data:image/png;base64,{{ base64_encode($generator->getBarcode($item->kode_barcode, $generator::TYPE_CODE_128)) }}"
                                            alt="">
                                        <small class="font-weight-bold">{{ strtoupper($item->kode_barcode) }}</small>
                                    @else
                                        <p>Tidak Ditemukan barcode</p>
                                    @endif
                                </td>
                                 <td class="d-none d-sm-table-cell">{{ $item->tempat_penjualan }}</td>
                                <td class="d-none d-sm-table-cell">{{ $item->created_at }}</td>

                                <td class="d-none d-sm-table-cell">
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#kirimEmail{{ $loop->iteration }}">
                                        <i class="fa fa-fw fa-check-to-slot"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="kirimEmail{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                aria-labelledby="kirimEmail{{ $loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-popin" role="document">
                                    <div class="modal-content">
                                        <div class="block block-rounded block-transparent mb-0">
                                            <div class="block-header block-header-default">
                                                <h3 class="block-title">bukti pembayaran</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content fs-sm ">
                                                <b>Apakah Anda Akan Mengirim Ulang Email AoM 10 :</b><br>
                                                Nama Pembeli : {{ $item->nama_lengkap }} <br>
                                                email : {{ $item->email }} <br>
                                                Tipe Tiket : {{ $item->nama_ticket }} <br>
                                                Kode Barcode : {{ $item->kode_barcode }} <br>
                                            </div>
                                            <div class="block-content block-content-full text-end bg-body">
                                                <form action="{{ route('resendMail.ticketing', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-secondary me-1"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-sm btn-danger me-1">Kirim
                                                        Email</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        
    </div>
    <script>
        function handleAjaxError(jqXHR, textStatus, errorThrown) {
            }
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
    </script>
    <!-- END Page Content -->
    @push('script')
        <!-- Page JS Plugins -->
        <script src="{{ asset('dashboard_assets/js/plugins/datatables/dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
        </script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
        </script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
        <!-- Page JS Code -->
        <script src="{{ asset('dashboard_assets/js/pages/be_tables_datatables.min.js') }}"></script>
    @endpush
@endsection
