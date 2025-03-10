@extends('User.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">User Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="col-xl-12 col-lg-8">
                

                <div class="tab-content">


                    <div class="tab-pane active show" id="post" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">History</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0" id="data_table">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 70px;">#</th>
                                                <th>Event Name</th>
                                                <th>Event Date</th>
                                                <th>Tickets</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
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

            function getEvents() {
                let user_id = `{{ $id }}`;
                $.ajax({
                    type: "GET",
                    url: `{{ url('User/Tickets/History/${user_id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let data = response.data;
                        let tr = '';
                        for (let i = 0; i < data.length; i++) {
                            tr += `<tr>
                                <td>${i + 1}</td>
                                <td><a href="{{ url('User/Event-Details/${data[i].event_id}') }}"> ${data[i].event_title}</a></td>
                                <td>${formatHumanReadableDate(data[i].event_date)}</td>
                                <td>${data[i].ticket_no}</td>
                            </tr>`;
                        }
                        $('#data_table tbody').html(tr);
                        $('#data_table').DataTable();
                    }
                });
            }

            $(document).ready(function() {
                
                getEvents()
            });
        </script>
    @endsection

    @section('style')
        <style>
            .img-fluid {
                max-width: 100%;
                height: 75px;
            }
        </style>
    @endsection
