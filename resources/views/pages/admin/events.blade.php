@extends('layouts.admin')
@section('titlePage', 'E-Ticket | event')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">event</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah event</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.event.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" placeholder="" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="Link" class="form-label">Link</label>
                                    <input type="text" class="form-control" id="link" placeholder="" name="link">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="status" placeholder="" name="status">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="form-control btn btn-primary" value="Tambahkan">
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">events</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5">No</th>
                                        <th>Nama</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$data->name}}</td>
                                        <td><a href="{{$data->link}}">{{$data->link}}</a></td>
                                        <td>{{ $data -> status }}</td>
                                        <td><a href="{{route('admin.event.destroy',$data->id)}}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                                            <a href=""><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
