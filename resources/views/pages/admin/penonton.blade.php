@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Dashboard')

@section('content')
    @push('style')
    @endpush
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Data Penonton
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
            <ul class="nav nav-tabs nav-tabs-block align-items-center" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="tiketblmkonfirm" data-bs-toggle="tab"
                        data-bs-target="#ticketblmkonfirm" role="tab" aria-controls="ticketblmkonfirm"
                        aria-selected="true">Tiket Belum Terkonfirmasi</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="btabswo-static-profile-tab1" data-bs-toggle="tab"
                        data-bs-target="#btabswo-static-profile1" role="tab" aria-controls="btabswo-static-profile"
                        aria-selected="false">Tiket Dikonfirmasi</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="btabswo-static-profile-tab2" data-bs-toggle="tab"
                        data-bs-target="#btabswo-static-profile2" role="tab" aria-controls="btabswo-static-profile"
                        aria-selected="false">Tiket Ditolak</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="btabswo-static-profile-tab3" data-bs-toggle="tab"
                        data-bs-target="#btabswo-static-profile3" role="tab" aria-controls="btabswo-static-profile"
                        aria-selected="false">Penonton Hadir / sudah mengambil ticket</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="btabswo-static-profile-tab4" data-bs-toggle="tab"
                        data-bs-target="#btabswo-static-profile4" role="tab" aria-controls="btabswo-static-profile"
                        aria-selected="false">Pengguna Website</button>
                </li>
            </ul>
            <div class="block-content tab-content block-content-full overflow-x-auto">
                <div class="tab-pane active " id="ticketblmkonfirm" role="tabpanel" aria-labelledby="tiketblmkonfirm"
                    tabindex="0">
                    <h3 class="block-title">Table Konfirmasi Pembayaran tiket</h3>
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th style="width: 20%;">nama</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Email</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Phone</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">Bukti Pembayaran</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Ticket</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">tanggal pembelian</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketblmdikonfirms as $ticketblmdikonfirm)
<tr>
    <td class="text-center fs-sm">{{ $loop->iteration }}</td>
    <td class="fw-semibold fs-sm">{{ $ticketblmdikonfirm->user->name }}</td>
    <td class="fw-semibold fs-sm">{{ $ticketblmdikonfirm->user->email }}</td>
    <td class="fw-semibold fs-sm">{{ $ticketblmdikonfirm->no_telp }}</td>
    <td class="d-none d-sm-table-cell fs-sm text-center">
        <button type="button" class="btn btn-sm btn-info" data-bs-target="#lihatbuktipembayaran{{ $loop->iteration }}" data-bs-toggle="modal">
            <i class="fa fa-fw fa-eye"></i>
        </button>
    </td>
    <td class="d-none d-sm-table-cell">{{ $ticketblmdikonfirm->ticket->name }}</td>
    <td class="d-none d-sm-table-cell">{{ $ticketblmdikonfirm->created_at }}</td>
    <td class="d-none d-sm-table-cell">
        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#konfirmasipembayaran{{ $loop->iteration }}">
            <i class="fa fa-fw fa-check-to-slot"></i>
        </button>
    </td>
</tr>

<div class="modal fade" id="lihatbuktipembayaran{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="lihatbuktipembayaran{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">bukti pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <img src="{{ url('imageslink/' . $ticketblmdikonfirm->bukti_pembayaran) }}" class="img-fluid" alt="">
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasipembayaran{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasipembayaran{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">bukti pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm ">
                    <img src="{{ $ticketblmdikonfirm->bukti_pembayaran ? url('imageslink/' . $ticketblmdikonfirm->bukti_pembayaran) : '#' }}" class="img-fluid" alt="">
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#tolakpembayaran{{ $loop->iteration }}">Tolak</button>
                    <button type="button" class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#terimapembayaran{{ $loop->iteration }}">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="terimapembayaran{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="terimapembayaran{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">bukti pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm ">
                    <b>Apakah Anda Akan Menerima Pembayaran Pembelian tiket Art Of Manunggalan 10 Dari :</b><br>
                    Nama Pembeli : {{ $ticketblmdikonfirm->user->name }} <br>
                    Email : {{ $ticketblmdikonfirm->user->email }} <br>
                    No Telepon : {{ $ticketblmdikonfirm->no_telp }} <br>
                    Tipe Tiket : {{ $ticketblmdikonfirm->ticket->name }} <br>
                    Harga Asli Tiket : Rp.{{ $ticketblmdikonfirm->ticket->price }} <br>
                    Uang Yang Dibayarkan : Rp.{{ $ticketblmdikonfirm->total_prices }} <br>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <form action="{{ route('confirm.tiket.penonton', $ticketblmdikonfirm->id_transaction) }}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="2" name="status_konfirmasi">
                        <input type="hidden" value="paid" name="status">
                        <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#konfirmasipembayaran{{ $loop->iteration }}">kembali</button>
                        <button type="submit" class="btn btn-sm btn-success me-1">Terima Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tolakpembayaran{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="tolakpembayaran{{ $loop->iteration }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">bukti pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm ">
                    <b>Apakah Anda Akan Menolak Pembayaran Pembelian tiket Art Of Manunggalan 10 Dari :</b><br>
                    Nama Pembeli : {{ $ticketblmdikonfirm->user->name }} <br>
                    email : {{ $ticketblmdikonfirm->user->email }} <br>
                    No Telepon : {{ $ticketblmdikonfirm->user->telp }} <br>
                    Tipe Tiket : {{ $ticketblmdikonfirm->ticket->name }} <br>
                    Harga Asli Tiket : Rp.{{ $ticketblmdikonfirm->ticket->price }} <br>
                    Uang Yang Dibayarkan : Rp.{{ $ticketblmdikonfirm->total_prices }} <br>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <form action="{{ route('confirm.tiket.penonton', $ticketblmdikonfirm->id_transaction) }}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="1" name="status_konfirmasi">
                        <input type="hidden" value="unpaid" name="status">
                        <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#konfirmasipembayaran{{ $loop->iteration }}">kembali</button>
                        <button type="submit" class="btn btn-sm btn-danger me-1">Tolak Pembayaran</button>
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
                <div class="tab-pane" id="btabswo-static-profile1" role="tabpanel"
                    aria-labelledby="btabswo-static-profile-tab" tabindex="0">
                    <h3 class="block-title">Table Konfirmasi Berhasil Pembayaran tiket</h3>
                    <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th style="width: 20%;">Barcode</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Email</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">Tipe Tiket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketsdhdikonfirms as $ticketsdhdikonfirm)
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                @endphp
                                <tr>
                                    <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                    <td class="fs-sm text-center">
                                        @if ($ticketsdhdikonfirm->kode_barcode != null)
                                        <img class="d-block mx-auto" width="200px"
                                        src="data:image/png;base64,{{ base64_encode($generator->getBarcode($ticketsdhdikonfirm->kode_barcode, $generator::TYPE_CODE_128)) }}"
                                        alt="">
                                    <small
                                        class="font-weight-bold">{{ strtoupper($ticketsdhdikonfirm->kode_barcode) }}</small>
                                        @else
                                            <p>Tidak Ditemukan barcode</p>
                                        @endif
                                    </td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsdhdikonfirm->user->name }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsdhdikonfirm->user->email }}</td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $ticketsdhdikonfirm->ticket->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="btabswo-static-profile2" role="tabpanel"
                    aria-labelledby="btabswo-static-profile-tab" tabindex="0">
                    <h3 class="block-title">Table Konfirmasi Pembayaran tiket ditolak</h3>
                    <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="d-none d-sm-table-cell" style="width:20%;">nama</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Email</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">No Telepon</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">tanggal pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketsditolaks as $ticketsditolak)
                                <tr>
                                    <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsditolak->user->name }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsditolak->user->email }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsditolak->user->telp }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketsditolak->user->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="btabswo-static-profile3" role="tabpanel"
                    aria-labelledby="btabswo-static-profile-tab" tabindex="0">
                    <h3 class="block-title">Table Penonton Yang sudah mengambil tiket</h3>
                    <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="d-none d-sm-table-cell" style="width:20%;">barcode</th>
                                <th class="d-none d-sm-table-cell" style="width:20%;">nama</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">Email</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">tanggal pembelian</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Status Pengambilan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketdiambils as $ticketdiambil)
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                @endphp
                                <tr>
                                    <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                    <td class="fs-sm text-center">
                                        @if ($ticketdiambil->kode_barcode != null)
                                            <img class="d-block mx-auto" width="150px"
                                                src="data:image/png;base64,{{ base64_encode($generator->getBarcode($ticketdiambil->kode_barcode, $generator::TYPE_CODE_128)) }}"
                                                alt="">
                                            <small
                                                class="font-weight-bold">{{ strtoupper($ticketdiambil->kode_barcode) }}</small>
                                        @else
                                        <p>Tidak Ditemukan Barcode</p>
                                        @endif
                                    </td>
                                    <td class="fw-semibold fs-sm">{{ $ticketdiambil->user->name }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketdiambil->user->email }}</td>
                                    <td class="fw-semibold fs-sm">{{ $ticketdiambil->user->created_at }}</td>
                                    <td class="fw-semibold fs-sm">
                                        @if ($ticketdiambil->presence == 1)
                                            <span
                                                class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light ">Sudah
                                                Diambil</span>
                                        @else
                                            <span
                                                class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Belum
                                                Diambil</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="btabswo-static-profile4" role="tabpanel"
                    aria-labelledby="btabswo-static-profile-tab" tabindex="0">
                    <h3 class="block-title">Table Pengguna Website Art Of Manunggalan</h3>
                    <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="d-none d-sm-table-cell" style="width:30%;">nama</th>
                                <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%;">No Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penggunawebsites as $penggunawebsite)
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                @endphp
                                <tr>
                                    <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold fs-sm">{{ $penggunawebsite->name }}</td>
                                    <td class="fw-semibold fs-sm">{{ $penggunawebsite->email }}</td>
                                    <td class="fw-semibold fs-sm">{{ $penggunawebsite->telp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
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
