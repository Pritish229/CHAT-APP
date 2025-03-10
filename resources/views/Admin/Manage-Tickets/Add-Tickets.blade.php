@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tickets</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('Admin.EventListPage') }}">Event List</a></li>
                                <li class="breadcrumb-item active">Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="card p-2">
                        <div class="d-flex justify-content-end">
                            <a href="javascript:history.back()" class="btn btn-primary"><i
                                    class="fas fa-arrow-left me-2"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3">
                <h4>Event Title : <strong id="evnt_title"></strong></h4>
                <h4>Total Tickets : <strong id="evnt_sets"></strong></h4>
                <h4>Remain Tickets : <strong id="evnt_remain"></strong></h4>
            </div>
            <div class="p-4">
                <form id="seatForm">
                    <div class="row">
                        <div class="col-md-6">
                            <x-inputbox type="number" placeholder="Enter number of rows" label="Total Rows" id="totalRows"
                                name="totalRows" value="{{ old('totalRows') }}" :required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-inputbox type="number" placeholder="Enter number of columns" label="Each Row's Columns"
                                id="totalColumns" name="totalColumns" value="{{ old('totalColumns') }}" :required="true" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="button" id="addPrefixes" class="btn btn-primary">Add Prefixes</button>
                        </div>
                    </div>
                    <div class="row mt-4 d-none" id="prefixSection">
                        <div class="col-12">
                            <div id="prefixInputs" class="row"></div>
                            <button type="button" id="saveButton" class="btn btn-primary mt-3 d-none">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @endsection

    @section('script')
        <script>
            function fetchEvent() {
                let id = '{{ $id }}';
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/Fatch-Event/${id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        const data = response.data;
                        $('#evnt_title').text(data.event_title);
                        $('#evnt_sets').text(data.total_tickets);
                        $('#evnt_remain').text(data.total_tickets);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to fetch event details.',
                        });
                    },
                    
                });
            }

            $(document).ready(function() {
                fetchEvent();

                $('#addPrefixes').on('click', function() {
                    if ($('#seatForm').valid()) {
                        const rows = parseInt($('#totalRows').val());
                        const columns = parseInt($('#totalColumns').val());
                        const totalTickets = rows * columns;
                        const remainTickets = parseInt($('#evnt_remain').text());

                        if (totalTickets !== remainTickets) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: `The product of Total Rows (${rows}) and Each Row's Columns (${columns}) must equal the Remaining Tickets (${remainTickets}).`,
                            });
                            return;
                        }

                        let prefixInputsHtml = '';
                        for (let i = 1; i <= rows; i++) {
                            prefixInputsHtml += `
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="prefixRow${i}" class="form-label">Prefix for Row ${i}</label>
                                    <input type="text" id="prefixRow${i}" name="prefixRow${i}" class="form-control prefix-input" placeholder="Enter prefix for row ${i}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="priceRow${i}" class="form-label">Price for Row ${i}</label>
                                    <input type="number" id="priceRow${i}" name="priceRow${i}" class="form-control price-input" placeholder="Enter price for row ${i}" required min="0">
                                </div>
                            </div>`;
                        }

                        $('#prefixInputs').html(prefixInputsHtml);
                        $('#prefixSection').removeClass('d-none');
                        $('#saveButton').removeClass('d-none');
                    }
                });

                $('#saveButton').on('click', function() {
                    const rows = parseInt($('#totalRows').val());
                    let isValid = true;
                    let prefixes = [];
                    let prefixSet = new Set();
                    const columns = parseInt($('#totalColumns').val());

                    for (let i = 1; i <= rows; i++) {
                        const prefix = $(`#prefixRow${i}`).val().trim();
                        const price = parseFloat($(`#priceRow${i}`).val().trim());

                        if (!prefix) {
                            isValid = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: `Prefix for Row ${i} cannot be empty.`,
                            });
                            break;
                        }

                        if (!price || price < 0) {
                            isValid = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: `Price for Row ${i} must be a positive number.`,
                            });
                            break;
                        }

                        if (prefixSet.has(prefix)) {
                            isValid = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Duplicate Prefix',
                                text: `Duplicate prefix "${prefix}" detected for Row ${i}. Prefixes must be unique.`,
                            });
                            break;
                        }

                        prefixSet.add(prefix);
                        prefixes.push({
                            row: i,
                            prefix: prefix,
                            price: price,
                            total_price: parseInt(price * columns)
                        });
                    }

                    if (!isValid) return;

                    let event_id = '{{ $id }}';
                    const payload = {
                        event_id: event_id,
                        totalRows: rows,
                        total_columns: columns,
                        prefixes: prefixes,
                    };

                    const saveButton = $(this);
                    saveButton.prop('disabled', true).text('Saving...');
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: `{{ url('Admin/Store-Tickets') }}`,
                        type: 'POST',
                        data: payload,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $('#totalRows').val('');
                            $('#totalColumns').val('');
                            $('#prefixInputs').html('');
                            $('#saveButton').addClass('d-none');
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: 'Prefixes and prices saved successfully.',
                            });
                            location.reload()
                            saveButton.prop('disabled', false).text('Save');
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON.message ||
                                    'An error occurred while saving the prefixes and prices.',
                            });
                            saveButton.prop('disabled', false).text('Save');
                        },
                    });
                });

                $('#seatForm').validate({
                    rules: {
                        totalRows: {
                            required: true,
                            min: 1,
                        },
                        totalColumns: {
                            required: true,
                            min: 1,
                        },
                    },
                    messages: {
                        totalRows: {
                            required: "Please enter the number of rows.",
                            min: "Number of rows must be at least 1.",
                        },
                        totalColumns: {
                            required: "Please enter the number of columns.",
                            min: "Number of columns must be at least 1.",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.addClass('text-danger');
                        error.insertAfter(element);
                    },
                });
            });
            


        </script>
    @endsection
