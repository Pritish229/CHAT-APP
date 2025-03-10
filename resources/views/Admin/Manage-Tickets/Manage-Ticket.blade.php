@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Preview Changes</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('Admin.TicketsListPage') }}">Manage
                                        Tickets</a></li>
                                <li class="breadcrumb-item active">Preview Changes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-lg-12 p-2">
                    <div class="card" id="event_banner"></div>
                </div>
                <div class="col-lg-8">
                    <div class="h4">Event Name : <strong id="evnt_title"></strong> ( <strong id="evnt_date"></strong> )
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="h5">Action : <strong id="event_action">

                        </strong></div>
                </div>
                <div class="col-lg-12">
                    <div class="h5">Total Tickets : <strong id="evnt_total"></strong> </div>
                </div>

                <h4 class="my-2">Ticket Details</h4>
                <div class="col-lg-12">
                    <table class="table table-bordered" id="tickets_data">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Row No</th>
                                <th>Total Seats</th>
                                <th>Single Seat Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <h4 class="my-2">All Tickets</h4>
                <div class="col-lg-12" id="tickets_preview_container">
                    <table class="table table-bordered" id="tickets_preview"></table>
                </div>

                <div class="col-lg-12 text-right my-3" id ="save_button">
                    <button id="saveButton" class="btn btn-primary">Publish</button>
                </div>
            </div>
        </section>
    @endsection

    @section('script')
        <script>
            function formatHumanReadableDate(datetime) {
                const dateObj = new Date(datetime);
                if (isNaN(dateObj)) {
                    return "Invalid Date";
                }
                return dateObj.toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
            }

            function generateGrid(row_no, total_columns, prefix) {
                let gridHtml = `<div class="m-3"> <strong> ${prefix} </strong> </div><table class="table">`;
                for (let i = 1; i <= total_columns; i++) {
                    gridHtml += `<td>${prefix}-${i}</td>`;
                }
                gridHtml += `</tr></table></td></tr>`;
                return gridHtml;
            }

            function fatchEvent() {
                let id = '{{ $id }}';
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/Fatch-Event/${id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);

                        const data = response.data;
                        $('#evnt_title').text(data.event_title);
                        $('#evnt_date').text(formatHumanReadableDate(data.event_date));
                        $('#evnt_total').text(data.total_tickets);
                        $('#event_banner').html(`<img src="${data.event_banner_url}" class="img-fluid" />`);

                        if (data.status == 0) {
                            $('#event_action').html(`<a href="{{ url('Admin/Edit-Event/' . $id . '/Page') }}">Edit</a> |
                            <a class="text-success" href="{{ url('Admin/Event-Fatch/' . $id . '/Page') }}">View</a>`);
                            $('#save_button').show()
                        } else {
                            $('#event_action').html(
                                `<a class="text-success" href="{{ url('Admin/Event-Fatch/' . $id . '/Page') }}">View</a>`
                            );
                            $('#save_button').hide()
                        }
                    }
                });
            }

            function Fatchtickets() {
                let id = '{{ $id }}';
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/tickets-Details/${id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        let list = response.data;
                        let tableBody = "";
                        let previewBody = "";
                        let totalSum = 0; // To calculate the total price

                        $.each(list, function(index, val) {
                            totalSum += parseFloat(val.total_price); // Add each row's total price
                            tableBody += `<tr>
                    <td>${val.row_prefix}</td>
                    <td>${val.row_no}</td>
                    <td>${val.total_column}</td>
                    <td>${val.price}</td>
                    <td>${val.total_price}</td>
                </tr>`;
                            previewBody += generateGrid(val.row_no, val.total_column, val.row_prefix);
                        });

                        // Append the Total row
                        tableBody += `<tr>
                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                <td><strong>${totalSum.toFixed(2)} Rs</strong></td>
            </tr>`;

                        $('#tickets_data tbody').empty().html(tableBody);
                        $('#tickets_preview').empty().html(previewBody);
                    }
                });
            }

            $(document).ready(function() {
                fatchEvent();
                Fatchtickets();
            });

            $('#saveButton').click(function() {
                // Disable the button temporarily and show loading text
                $(this).prop('disabled', true).text('Preparing to Publish...');

                let tickets = [];
                $('#tickets_data tbody tr').each(function() {
                    const type = $(this).find('td:nth-child(1)').text()
                        .trim(); // Ticket Type (e.g., VIP, General, etc.)
                    const totalSeats = parseInt($(this).find('td:nth-child(3)').text().trim(),
                        10); // Total Seats
                    const price = parseFloat($(this).find('td:nth-child(4)').text().trim()); // Price per seat

                    // Generate ticket objects for each seat
                    for (let i = 1; i <= totalSeats; i++) {
                        tickets.push({
                            ticket_no: `${type}-${i}`, // e.g., VIP-1
                            ticket_type: type, // e.g., VIP
                            ticket_price: price,
                            status: '0'
                        });
                    }
                });

                const payload = {
                    event_id: '{{ $id }}', // Use the actual event ID
                    tickets: tickets,

                };


                // SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to Publish the tickets?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Publish it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: "POST",
                            url: `{{ url('Admin/Save-Seats') }}`,
                            data: JSON.stringify(payload),
                            contentType: "application/json",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Saved!',
                                    'Tickets have been Published successfully.',
                                    'success'
                                );
                                $('#saveButton').text('Published');
                                window.location.href = (`{{ route('Admin.EventListPage') }}`);
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'There was an error saving the tickets. Please try again.',
                                    'error'
                                );
                                $('#saveButton').prop('disabled', false).text('Published');
                            }
                        });
                    } else {
                        // If user cancels, re-enable the button
                        $('#saveButton').prop('disabled', false).text('Published');
                    }
                });
            });
        </script>
    @endsection
