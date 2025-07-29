@extends('layouts.admin')

@section('titlePage', 'E-Ticket | Users')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data {{ $title }}</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more
            information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form method="get">
                    @php
                        $status = request()->query('status');
                    @endphp
                    <ul class="nav nav-tabs border-0">
                        <li class="nav-item">
                            <button type="submit" name="status" value="users"
                                class="btn nav-link {{ !$status || $status == 'users' ? ' active btn-secondary' : '' }}"
                                href="#">Pendaftar</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" name="status" value="unconfirm"
                                class="btn nav-link {{ $status == 'unconfirm' ? ' active btn-warning' : '' }}"
                                href="#">Belum
                                Terkonfirmasi</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" name="status" value="rejected"
                                class="btn nav-link {{ $status == 'rejected' ? ' active btn-danger' : '' }}"
                                href="#">Ditolak</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" name="status" value="confirmed"
                                class="btn nav-link {{ $status == 'confirmed' ? ' active btn-primary' : '' }}"
                                href="#">Terkonfirmasi</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" name="status" value="presenced"
                                class="btn nav-link {{ $status == 'presenced' ? ' active btn-success' : '' }}">Hadir</button>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                @if ($status == 'confirmed')
                                    <th>Barcode</th>
                                @endif
                                <th>Tanggal</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                @if ($status == 'unconfirm')
                                    <th>Bukti Pembayaran</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if ($status == 'confirmed')
                                        <td class="text-center">
                                            @php
                                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            @endphp
                                            <img class="d-block mx-auto" width="200px"
                                                src="data:image/png;base64,{{ base64_encode($generator->getBarcode($usr->code, $generator::TYPE_CODE_128)) }}"
                                                alt="">
                                            <small class="font-weight-bold">{{ strtoupper($usr->code) }}</small>
                                        </td>
                                    @endif
                                    <td>{{ $usr->updated_at }}</td>
                                    <td>{{ $usr->name }}</td>
                                    <td>{{ $usr->email }}</td>
                                    <td>{{ $usr->telp }}</td>
                                    @if ($status == 'unconfirm')
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary" tabindex="1"
                                                data-toggle="modal" data-target="#user{{ $loop->iteration }}">
                                                Lihat
                                            </button>
                                        </td>
                                    @endif
                                </tr>

                                <!-- Modal -->
                                    @if ($status == 'unconfirm')
                                <div class="modal fade" id="user{{ $loop->iteration }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="user{{ $loop->iteration }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="user{{ $loop->iteration }}Label">
                                                    Bukti Pembayaran</h5>
                                                <button type="button" class="close" tabindex="-1" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="no_reff">No Reference</label>
                                                    <input readonly id="no_reff" type="text" name="no_reff"
                                                        value="{{ $usr->no_reference }}" class="form-control"
                                                        tabindex="-1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="payment">Bukti Pembayaran</label>
                                                    <img src="{{ url($usr->payment) }}" class="img-fluid w-100 h-auto">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    tabindex="1">Kembali</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                    data-toggle="modal" data-target="#modalKonfirmasi" tabindex="1">
                                                    Konfirmasi
                                                </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                    data-toggle="modal" data-target="#modalTolak" tabindex="1">
                                                    Tolak
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif


                                <!-- Konfirmasi -->
                                <div class="modal fade" id="modalKonfirmasi" data-backdrop="static"
                                    data-keyboard="false" tabindex="1" aria-labelledby="modalKonfirmasiLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalKonfirmasiLabel">Yakin</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('admin.users.confirm', $usr->id) }}">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    Yakin ingin mengonfirmasi data ini ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" tabindex="2" class="btn btn-secondary"
                                                        data-dismiss="modal" data-toggle="modal">
                                                        Kembali
                                                    </button>
                                                    <button type="submit" name="confirm" tabindex="1" value="2"
                                                        class="btn btn-primary">Konfirmasi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tolak --}}
                                <div class="modal fade" id="modalTolak" data-backdrop="static" data-keyboard="false"
                                    tabindex="1" aria-labelledby="modalTolakLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTolakLabel">Yakin</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('admin.users.confirm', $usr->id) }}">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    Yakin ingin menolak data ini ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" tabindex="3"
                                                        data-dismiss="modal" data-toggle="modal">
                                                        Kembali
                                                    </button>
                                                    <button type="submit" name="confirm" value="1" tabindex="2"
                                                        class="btn btn-danger">Tolak</button>
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
@endsection
