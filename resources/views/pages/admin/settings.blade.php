@extends('layouts.admin')
@section('titlePage', 'E-Ticket | Pengaturan')
@section('content')
    @push('style')
        <script src="{{ url('assets/vendor/ckeditor_full/ckeditor.js') }}"></script>
    @endpush
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pengaturan</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Gagal!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Buka</th>
                                <th>Tanggal Tutup</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setting as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->id == '1' ? 'Peserta bazar' : 'Penonton' }}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->opening_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->closing_date)) }}</td>
                                    <td class="text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#settingModal{{ $item->id }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="settingModal{{ $item->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="settingModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="settingModalLabel">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.settings.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label>Tanggal Buka</label>
                                                            <input type="date" class="form-control" required
                                                                name="opening_date"
                                                                value="{{ old('opening_date', $item->opening_date) }}">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Tanggal Tutup</label>
                                                            <input type="date" class="form-control" required
                                                                name="closing_date"
                                                                value="{{ old('closing_date', $item->closing_date) }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea class="CKEditor" required name="description_">{!! $item->description !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            CKEDITOR.replaceAll('CKEditor');
        </script>
    @endpush
@endsection
