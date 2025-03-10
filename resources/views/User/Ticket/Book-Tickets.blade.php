@extends('User.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Book Tickets</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Book Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket List Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Tickets</h4>
                            <div id="ticketGridContainer"></div>
                            <button id="bookTicketsBtn" class="btn btn-primary mt-3" style="display: none;"
                                data-bs-toggle="modal" data-bs-target="#ticketModal">Book It</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Popup -->
            <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ticketModalLabel">Selected Tickets</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="selectedTicketsList"></ul>
                            <h5>Total Price: <span id="totalPrice"></span></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="confrm_book">Confirm Booking</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function EventTickets() {
            var eventId = `{{ $id }}`;
            $.ajax({
                url: `{{ url('User/Tickets/List/${eventId}') }}`,
                type: 'GET',
                success: function(response) {
                    generateTicketGrid(response);
                }
            });
        }

        function generateTicketGrid(ticketData) {
            let html = '';
            let ticketTypes = Object.keys(ticketData);

            ticketTypes.forEach(type => {
                html += `<h5 class="my-3">${type}</h5> `;
                html += '<div class="d-flex flex-wrap gap-3 mb-3"> ';

                ticketData[type].forEach(ticket => {
                    let borderClass = ticket.status === "1" ? 'border-danger' : 'border-primary';
                    let disabled = ticket.status === "1" ? 'disabled' : '';

                    html += `
                    <div class="ticket-item p-2 w-auto text-center ${borderClass}"  data-ticketno="${ticket.ticket_no}" data-price="${ticket.ticket_price}" style="width: 80px; height: 50px; cursor: pointer; border: 2px solid; border-radius: 5px;" ${disabled}>
                        <i class="fas fa-couch" class="${borderClass}"></i> ${ticket.ticket_no}
                        ${ticket.status === "0" ? '<input type="checkbox" class="d-none">' : ''}
                    </div>`;
                });

                html += '</div>';
            });

            $('#ticketGridContainer').html(html);

            // Click event for tickets
            $('.ticket-item').on('click', function() {
                if ($(this).hasClass('border-danger')) return; // Ignore unavailable tickets
                $(this).toggleClass('border-success'); // Toggle selection
                toggleBookButton();
            });
        }

        function toggleBookButton() {
            let selectedTickets = $('.ticket-item.border-success');
            if (selectedTickets.length > 0) {
                $('#bookTicketsBtn').show();
            } else {
                $('#bookTicketsBtn').hide();
            }
        }

        // Book Tickets Button Click Event
        $('#bookTicketsBtn').on('click', function() {
            let selectedTickets = [];
            let totalPrice = 0;

            $('.ticket-item.border-success').each(function() {
                let ticketNo = $(this).data('ticketno');
                let price = parseFloat($(this).data('price'));
                totalPrice += price;
                selectedTickets.push(`Ticket ${ticketNo} - ${price} Rs`);
            });

            $('#selectedTicketsList').html(selectedTickets.map(ticket => `<li>${ticket}</li>`).join(''));
            $('#totalPrice').text(`${totalPrice} Rs`);
        });

        // Confirm Booking Button Click Event
        $('#confrm_book').on('click', function() {
            let eventId = `{{ $id }}`;
            let selectedTickets = [];

            $('.ticket-item.border-success').each(function() {
                selectedTickets.push({
                    ticket_no: $(this).data('ticketno'),
                    price: parseFloat($(this).data('price'))
                });
            });

            if (selectedTickets.length === 0) {
                alert('No tickets selected.');
                return;
            }

            $.ajax({
                url: `{{ url('User/ConfirmBooking/Ticket') }}`,
                type: 'POST',
                data: {
                    _token: `{{ csrf_token() }}`,
                    event_id: eventId,
                    purchease_by: `{{ Session::get('user_id') }}`, // Use Blade syntax to inject session value
                    tickets: selectedTickets
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'Success',
                        title: 'Booking Successfull!',
                        showConfirmButton: true,
                        timer: 1500
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('An error occurred while processing your booking.');
                }
            });
        });

        $(document).ready(function() {
            EventTickets();
        });
    </script>
@endsection
