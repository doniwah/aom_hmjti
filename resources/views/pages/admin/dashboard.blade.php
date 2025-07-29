@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Dashboard')

@section('content')


    <!-- Hero -->
    <div class="content">
        <div
            class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome <a class="fw-semibold" href="#">{{ Auth::user()->name }}</a>, everything looks great.
                </h2>
            </div>

        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Overview -->
        <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $ticketsdhdibayars }}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Jumlah Tiket Berhasil Dibayar</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fas fa-check fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('index.penonton') }}">
                            <span>Lihat Jumlah Tiket Berhasil Dibayar</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END New Customers -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    @foreach($transaksiperhari as $item)
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $item["name"] }}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Jumlah Penjualan: {{$item["jumlah"]}} </dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fas fa-check fs-3 text-primary"></i>
                        </div>
                    </div>
                    @endforeach
                  
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                            <span>Jumlah Penjualan Perhari Yang Sudah Dikonfirmasi</span>
                        </a>
                    </div>
                </div>
                <!-- END New Customers -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Messages -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $ticketdiambils }}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Jumlah Pembeli Menghadiri Acara</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fas fa-barcode fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('index.penonton') }}">
                            <span>Lihat Jumlah Pembeli Menghadiri Acara</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Messages -->
            </div>
        </div>
        <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
            <thead>
                <tr>
                    <th class="text-center" style="width: 70px;">No</th>
                    <th class="d-none d-sm-table-cell" style="width: 40%;">Nama Ticket</th>
                    <th class="d-none d-sm-table-cell" style="width: 25%;">Total Penjualan</th>
                    <th class="d-none d-sm-table-cell" style="width: 25%;">Transaksi Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualanticket as $item)
                    <tr>
                        <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                        <td class="fw-semibold fs-sm">{{ $item->name_ticket }}</td>
                        <td class="fw-semibold fs-sm">{{ $item->transaction_count }}</td>
                         <td class="fw-semibold fs-sm">{{ $item->last_transaction }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <!-- END Overview -->
    </div>
    <!-- END Page Content -->
    @push('script')
        <!-- Page JS Plugins -->
        <script src="{{ asset('dashboard_assets/js/plugins/chart.js/chart.umd.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('dashboard_assets/js/pages/be_pages_dashboard.min.js') }}"></script>
    @endpush
@endsection
