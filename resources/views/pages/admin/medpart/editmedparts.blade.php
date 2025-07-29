@extends('layouts.admin')
@section('titlePage', 'E-Ticket | Sponsorship')
@section('content')
    @push('style')
        <link rel="stylesheet" href="{{ asset('dashboard_assets/js/plugins/select2/css/select2.min.css') }}">
    @endpush
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-1">
                        Edit Medpart
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-content tab-content block-content-full overflow-x-auto"> 
                <form action="{{ route('admin.medpart.update',$medpart->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="name">Nama Medpart</label>
                                <input type="text" value="{{ $medpart->name }}" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama Medpart">
                        </div>
                        <div class="col-12  mb-3 ">
                            <label class="form-label" for="example-file-input">Logo Sponsor</label>
                            <input class="form-control" type="file" name="logo" accept="image/*">
                        </div>
                        <div class="col-12 text-center ">
                            <h1>Logo Sponsor</h1><br>
                            <img src="{{ url('storage/'.$medpart->logo) }}" width="200" height="200" class="img-thumbnail shadow" alt="">
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.medpart') }}" class="btn btn-secondary">kembali</a>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form> 
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    @push('script')
        <script src="{{ asset('dashboard_assets/js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            One.helpersOnLoad(['jq-select2']);
        </script>
    @endpush
@endsection
