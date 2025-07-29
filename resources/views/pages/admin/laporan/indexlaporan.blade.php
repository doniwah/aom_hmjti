@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Laporan')

@section('content')
<!-- Hero Section -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h2 class="h3 fw-bold mb-1">
                    Laporan Penjualan
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content">
    <!-- Block Section -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Export Laporan Penjualan</h3>
        </div>
        <div class="block-content tab-content block-content-full overflow-x-auto">
            <!-- Button to open modal -->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exportModal">
                Export Laporan
            </button>
        </div>
    </div>
</div>

<!-- Modal for Export -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="exportForm" action="{{ route('admin.laporan.export') }}" method="GET">
                    <!-- Nama File -->
                    <div class="form-group mb-3">
                        <label for="nama_file">Nama File</label>
                        <input type="text" name="nama_file" id="nama_file" class="form-control" placeholder="Masukkan Nama File (Opsional)">
                    </div>

                    <!-- Tipe File -->
                    <div class="form-group mb-3">
                        <label for="tipe_file">Tipe File</label>
                        <select name="tipe_file" id="tipe_file" class="form-control">
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="csv">CSV (.csv)</option>
                            <option value="pdf">PDF (.pdf)</option>
                        </select>
                    </div>

                    <!-- Filter Status Konfirmasi -->
                    <div class="form-group mb-3">
                        <label for="confirmation_filter">Status Konfirmasi</label>
                        <select name="confirmation_filter" id="confirmation_filter" class="form-control">
                            <option value="">Semua</option>
                            <option value="confirmed">Diterima</option>
                            <option value="unconfirmed">Ditolak</option>
                        </select>
                    </div>

                    <!-- Filter Kehadiran Tiket -->
                    <div class="form-group mb-3">
                        <label for="presence_filter">Kehadiran Tiket</label>
                        <select name="presence_filter" id="presence_filter" class="form-control">
                            <option value="">Semua</option>
                            <option value="1">Sudah Diambil</option>
                            <option value="0">Belum Diambil</option>
                        </select>
                    </div>
                    <!-- Filter Tanggal -->
                    <div class="form-group">
                        <label for="tanggal">Tanggal Start</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_end">Tanggal End</label>
                        <input type="date" name="tanggal_end" id="tanggal_end" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="presence_filter">Tipe Transaksi</label>
                        <select name="transaction_type" id="presence_filter" class="form-control">
                            <option value="offline">Offline</option>
                            <option value="website">Website</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-info" form="exportForm">Export Laporan</button>
            </div>
        </div>
    </div>
</div>
@endsection
