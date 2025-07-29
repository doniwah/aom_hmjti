@extends('layouts.admin')
@section('titlePage', 'E-voucher | voucher')
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-1">
                        Voucher
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"></h3>
                <div class="block-options ">
                    <button data-bs-target="#tambahvoucher" data-bs-toggle="modal" type="button" class="btn btn-primary">
                        <i class="fa fa-fw fa-plus me-1"></i> tambah Voucher
                    </button>
                </div>
            </div>
            <div class="block-content tab-content block-content-full overflow-x-auto">
                <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Tiket</th>
                            <th class="d-none d-sm-table-cell">Harga</th>
                            <th class="d-none d-sm-table-cell">Mulai</th>
                            <th class="d-none d-sm-table-cell">Selesai</th>
                            <th class="d-none d-sm-table-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fs-sm text-center">{{ $voucher->kode }}</td>
                                <td class="fs-sm text-center">{{ $voucher->discount }}</td>
                                <td class="fs-sm text-center">{{ $voucher->start_date }}</td>
                                <td class="fs-sm text-center">{{ $voucher->end_date }}</td>
                                <td class="text-center">
                                    <form action="{{ route('Voucher.destroy',$voucher->id_voucher) }}" method="POST"  onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('delete')
                                        <div class="btn-group">
                                            <a type="button" href="{{ route('Voucher.edit',$voucher->id_voucher) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                                title="Delete">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <div class="modal" id="tambahvoucher" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah voucher</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('Voucher.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="block-content">
                            <div class="mb-2">
                                <label class="form-label" for="nama_sponsor">Nama voucher</label>
                                <input type="text" class="form-control" id="nama_sponsor" name="name"
                                    placeholder="Masukan Nama voucher">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="nama_sponsor">Harga voucher</label>
                                <input type="number" class="form-control" id="nama_sponsor" name="price"
                                    placeholder="Masukan Harga voucher">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="nama_sponsor">Quantity voucher</label>
                                <input type="number" class="form-control" id="nama_sponsor" name="quantity"
                                    placeholder="Masukan Quantity voucher">
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
        <script src="{{ asset('dashboard_assets/js/lib/jquery.min.js') }}"></script>
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
