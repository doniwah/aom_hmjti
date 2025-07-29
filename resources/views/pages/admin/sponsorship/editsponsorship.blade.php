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
                        Edit Sponsorship
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-content tab-content block-content-full overflow-x-auto"> 
                <form action="{{ route('admin.sponsorship.update',$sponsorships->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="name">Nama Sponsor</label>
                                <input type="text" value="{{ $sponsorships->name }}" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama Sponsor">
                        </div>
                        <div class="col-12 col-md-6 ">
                            <label class="form-label" for="example-text-input-sm">Kategori Sponsor</label>
                                <select class="js-select2 form-select" id="id_sponsorship_categori"
                                    name="id_sponsorship_categori" style="width: 100%;" data-container="#tambahsponsor"
                                    data-placeholder="Choose one..">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($sponsorshipscategoriesdata as $sponsorshipscategori)
                                        <option {{ ($sponsorships->id_sponsorship_categori == $sponsorshipscategori->id_sponsorship_categori) ? 'selected' : '' }} value="{{ $sponsorshipscategori->id_sponsorship_categori }}">
                                            {{ $sponsorshipscategori->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3 ">
                            <label class="form-label" for="example-file-input">Logo Sponsor</label>
                            <input class="form-control" type="file" name="logo" accept="image/*">
                        </div>
                        <div class="col-12 text-center ">
                            <h1>Logo Sponsor</h1><br>
                            <img src="{{ url('imageslink/'.$sponsorships->logo) }}" width="200" height="200" class="img-thumbnail shadow" alt="">
                        </div>
                    </div>
                    <div class="text-end">
                        <a hre class="btn btn-secondary">kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
