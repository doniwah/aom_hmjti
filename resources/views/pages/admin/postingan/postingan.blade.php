@extends('layouts.admin')
@section('titlePage', 'E-Ticket | Ticket')
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-1">
                        Postingan
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
            </div>
            <div class="block-content tab-content block-content-full overflow-x-auto">
                <table class="table table-hover table-bordered  table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="">Media type</th>
                            <th>Instagram Video / Foto</th>
                            <th>Link Menuju Instagram</th>
                            <th>Thumbnail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postingans as $postingan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fs-sm text-center">{{ $postingan->media_type }}</td>
                                <td class="fs-sm text-center">@if ($postingan->media_type == 'IMAGE' || $postingan->media_type == 'CAROUSEL_ALBUM')
                                    <img lazy src="{{ $postingan->media_url }}" class="img-fluid" style="height: 50%" alt="">
                                @elseif($postingan->media_type == 'VIDEO')
                                    <video controls lazy src="{{ $postingan->media_url }}" class="img-fluid" style="height: 50%" alt=""></video>
                                @endif</td>
                                <td class="fs-sm text-center"><a href="{{ $postingan->permalink  }}" target="__blank" class="btn btn-primary rounded"><i class="fa-brands fa-instagram"></i></a></td>
                                <td class="fs-sm text-center"><img src="{{ $postingan->thumbnail_url }}" class="img-fluid" alt=""></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    @push('script')
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
