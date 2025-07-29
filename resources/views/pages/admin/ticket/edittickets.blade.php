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
                <form action="{{ route('Ticket.update', $ticket->idTicket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Nama Ticket</label>
                            <input type="text" value="{{ $ticket->name }}" class="form-control" id="nama_ticket"
                                name="name" placeholder="Masukan Nama Ticket">
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Harga Ticket</label>
                            <input type="number" value="{{ $ticket->price }}" class="form-control" id="nama_ticket"
                                name="price" placeholder="Masukan Harga Ticket">
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label" for="nama_sponsor">Quantity Ticket</label>
                            <input type="number" value="{{ $ticket->quantity }}" class="form-control" id="nama_ticket"
                                name="quantity" placeholder="Masukan Quantity Ticket">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label" for="nama_sponsor">Benefit Ticket
                                <button type="button" class="btn btn-sm btn-secondary" id="add-benefit">Tambah
                                    Benefit</button>
                            </label>
                            <div id="benefit-container">
                                @foreach ($ticket->ticket_benefit as $benefit)
                                    <div class="benefit-input-group">
                                        <div class="input-group">
                                            <input type="text" value="{{ $benefit->name }}" class="form-control mb-2"
                                                name="benefit_ticket[]" placeholder="Masukan Benefit Ticket">
                                            <button type="button"
                                                class="btn btn-danger mb-2 btn-sm remove-benefit">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
        <script>
            document.getElementById('add-benefit').addEventListener('click', function() {
                var benefitContainer = document.getElementById('benefit-container');

                // Create a new div for the benefit input group
                var benefitInputGroup = document.createElement('div');
                benefitInputGroup.setAttribute('class', 'benefit-input-group mb-2');

                // Create a new div for the input group (input and button)
                var inputGroup = document.createElement('div');
                inputGroup.setAttribute('class', 'input-group');

                // Create a new input element
                var newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('class', 'form-control mb-2');
                newInput.setAttribute('name', 'benefit_ticket[]');
                newInput.setAttribute('placeholder', 'Masukan Benefit Ticket');

                // Create a remove button
                var removeButton = document.createElement('button');
                removeButton.setAttribute('type', 'button');
                removeButton.setAttribute('class', 'btn btn-danger btn-sm mb-2 remove-benefit');
                removeButton.textContent = '-';

                // Append the input and remove button to the input group div
                inputGroup.appendChild(newInput);
                inputGroup.appendChild(removeButton);

                // Append the input group to the benefit input group div
                benefitInputGroup.appendChild(inputGroup);

                // Append the new benefit input group to the container
                benefitContainer.appendChild(benefitInputGroup);

                // Add event listener for the remove button with validation
                removeButton.addEventListener('click', function() {
                    if (document.querySelectorAll('.benefit-input-group').length > 1) {
                        benefitInputGroup.remove();
                    } else {
                        alert('Tidak dapat menghapus inputan terakhir.');
                    }
                });
            });

            // This part will attach the click event to already existing remove buttons.
            document.querySelectorAll('.remove-benefit').forEach(function(button) {
                button.addEventListener('click', function() {
                    if (document.querySelectorAll('.benefit-input-group').length > 1) {
                        button.closest('.benefit-input-group').remove();
                    } else {
                        alert('Tidak dapat menghapus inputan terakhir.');
                    }
                });
            });
        </script>
        <script src="{{ asset('dashboard_assets/js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            One.helpersOnLoad(['jq-select2']);
        </script>
    @endpush
@endsection
