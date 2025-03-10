@extends('Admin.layout.app')

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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm order-2 order-sm-1">
                                <div class="d-flex align-items-start mt-3 mt-sm-0">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xl me-3" id="profile_user_img">

                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-16 mb-1" id="profile_user_name">User Name</h5>
                                            <p class="text-muted font-size-13">Role : User</p>

                                            <div
                                                class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">

                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>
                                                    <span id="user_email"></span>
                                                </div>
                                                <div><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i><span
                                                        id="user_phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link px-3 active" data-bs-toggle="tab" href="#post" role="tab"
                                    aria-selected="true">Events</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="tab-content">


                    <div class="tab-pane active show" id="post" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Events</h5>
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
            function getDetails() {
                let user_id = `{{ $id }}`;
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/profile/${user_id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let data = response.data;
                        $('#profile_user_img').html(
                            `<img src="${response.profile_image}" alt="" class="img-fluid rounded-circle d-block">`
                        );
                        $('#profile_user_name').text(data.f_name);
                        $('#user_email').text(data.email);
                        $('#user_phone').text(data.phone_no);
                    }
                });
            }

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
                    url: `{{ url('Admin/User-Tickets/${user_id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let data = response.data;
                        let tr = '';
                        for (let i = 0; i < data.length; i++) {
                            tr += `<tr>
                                <td>${i + 1}</td>
                                <td><a href="{{ url('/Admin/Event-Fatch/${data[i].event_id}/Page') }}"> ${data[i].event_title}</a></td>
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
                getDetails();
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
