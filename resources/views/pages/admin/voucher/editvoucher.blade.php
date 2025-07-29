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
                        Edit Ticket
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-content tab-content block-content-full overflow-x-auto">
                <form action="{{ route('Ticket.update',$ticket->idTicket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Nama Ticket</label>
                                <input type="text" value="{{ $ticket->name }}" class="form-control" id="nama_ticket" name="name"
                                    placeholder="Masukan Nama Ticket">
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Harga Ticket</label>
                                <input type="number" value="{{ $ticket->price }}" class="form-control" id="nama_ticket" name="price"
                                    placeholder="Masukan Harga Ticket">
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Quantity Ticket</label>
                                <input type="number" value="{{ $ticket->quantity }}" class="form-control" id="nama_ticket" name="quantity"
                                    placeholder="Masukan Quantity Ticket">
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('Ticket.index') }}" class="btn btn-secondary">kembali</a>
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
