@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage Tickets</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('Admin.Dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="data_table">
                                    <thead>
                                        <tr>
                                            <th>Event Code</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Total Tickets</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection


    @section('script')
        <script>
            $(document).ready(function() {
                fatchEventlist();
            });

            function clearTable() {
                $('#data_table').DataTable().clear().destroy();
                $('#data_table tbody').empty();
            }

            function fatchEventlist() {
                clearTable()
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/List-Events') }}`,
                    dataType: "json",
                    success: function(response) {
                        const list = response.data;
                        let counter = 1;
                        

                        if (list.length > 0) {
                            $.each(list, function(index, val) {
                                const data = `
                        <tr>
                            <td>${val.event_code}</td>
                            <td class="oneLine"><img class=" w-100 header-profile-user" src="${val.event_banner_url}" alt=""></td>
                            <td class="oneLine">${val.event_title}</td>
                            <td class="oneLine">${val.event_date}</td>
                            <td class="oneLine">${val.total_tickets}</td>
                            <td nowrap style="max-width: 200px;">
                                <span class="${val.status === '0' ? 'text-secoandry' : val.status === '1' ? 'text-warning' : 'text-success'}">
                                    ${val.status === '0' ? 'Archive' : val.status === '1' ? 'Published' : 'Completed'}
                                </span>
                            </td>
                            <td nowrap>
                                <a href="{{ url('Admin/Add-Tickets/${val.id}/${val.total_tickets}') }}" class="btn btn-secondary btn-sm " data-view-val="${val.id}">Tickets</a>
                                
                            </td>
                        </tr>
                    `;
                                $('#data_table tbody').append(data);
                            });

                            // Reinitialize DataTable after loading new data
                            $('#data_table').DataTable({
                                deferRender: true,
                                processing: true,
                            });
                            $('.select2').select2();
                        } else {
                            $('#data_table').DataTable({
                                deferRender: true,
                                processing: true,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: "Error",
                            text: "Failed to load department list.",
                        });
                    }
                });
            }
        </script>

        <script>
            $(document).on('change', '.select-status', function() {
                const id = $(this).data('id');
                const status = $(this).val();
                console.log(status);

                $.ajax({
                    type: "PATCH",
                    url: `{{ url('Admin/Status-Event/${id}') }}`,
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Status  Changed",
                                text: "Event Status Changed",
                                showConfirmButton: true,
                                timer: 1500
                            });
                        }
                    }
                });

            });
        </script>
    @endsection
