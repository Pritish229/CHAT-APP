@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View Events</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">View Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="mb-2">
                <div class="col-lg-12">
                    <div class="card  p-2">
                        <div class="d-flex justify-content-end">
                            <a href="javascript:history.back()" class="btn btn-primary"><i
                                    class="fas fa-arrow-left me-2"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-2">
                    <div class="card " id="event_banner">
                    </div>
                </div>


                <div class="col-lg-8">
                    <div class="h4">Event Name : <strong id="evnt_title"></strong> ( <strong id="evnt_date"></strong> )
                    </div>
                </div>
                <div class="col-lg-4">

                        <div class="h5">Action : <strong id="edit_action"> </strong> </div>
                 
                </div>
                <div class="col-lg-12">
                    <div class="h5">Total Tickets : <strong id="evnt_total"></strong> </div>
                </div>


                <div class="col-lg-12">
                    <div class="h5">Status : <span id="status_id"></span> </div>
                </div>


                <div class="col-lg-6 mt-2">
                    <div class="h5">Address : <span id="state_id"></span> , <span id="dist_id"></span> <span
                            id="city_id"></span>, <span id="pincode_id"></span> </div>
                </div>
                <div class="col-lg-12">
                    <h4 class="mt-3">Event Details</h4>
                    <div id="details" class="my-3"></div>
                    <hr>
                </div>


            </div>
        </section>
    @endsection

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
        <script>
            function formatHumanReadableDate(datetime) {
                const dateObj = new Date(datetime);

                if (isNaN(dateObj)) {
                    return "Invalid Date";
                }

                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true, // Converts to 12-hour format with AM/PM
                };

                return dateObj.toLocaleString('en-US', options);
            }

            function fatchEvent() {
                let id = '{{ $id }}';
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/Fatch-Event/${id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        const data = response.data;
                        $('#evnt_title').text(data.event_title);
                        $('#evnt_date').text(formatHumanReadableDate(data.event_date));

                        $('#pincode_id').text(data.pincode);
                        $('#dist_id').text(data.district_title);
                        $('#city_id').text(data.city_title);
                        $('#state_id').text(data.state_title);

                        $('#details').html(data.event_desc);
                        if (data.status == "0") {
                            $('#status_id').text('Archive').addClass('text-secondary');
                        } else if (data.status == '1') {
                            $('#status_id').text('Published').addClass('text-warning');
                        } else if (data.status == "2") {
                            $('#status_id').text('Completed').addClass('text-success');
                        }

                        console.log(data);
                        
                        if (data.status == '0') {
                            $('#edit_action').html(`<a
                                    href="{{ url('Admin/Edit-Event/' . $id . '/Page') }}">Edit</a>`)
                        }
                        if (data.status == 1) {
                            $('#edit_action').html(`<a
                                    href="" class="text-danger">Live</a>`)
                        }
                        
                       
                        $('#evnt_total').text(data.total_tickets);

                        $('#event_banner').html(`<img src="${data.event_banner_url}" />`);

                    }
                });
            }



            $(document).ready(function() {
                fatchEvent();

            });
        </script>
    @endsection
