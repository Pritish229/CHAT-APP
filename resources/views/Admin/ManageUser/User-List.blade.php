@extends('Admin.layout.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Manage Users</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('Admin.Dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Users</li>
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
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone no</th>
                                        <th>Role</th>
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
   

      $(document).ready(function () {
        fatchUserlist();
      });

      function clearTable() {
            $('#data_table').DataTable().clear().destroy();
            $('#data_table tbody').empty();
        }

      function fatchUserlist() {
        clearTable()
            $.ajax({
                type: "GET",
                url: `{{ url('Admin/List-Users') }}`,
                dataType: "json",
                success: function(response) {
                    const list = response.data;
                  
                    
                    let counter = 1;

                    if (list.length > 0) {
                        $.each(list, function(index, val) {
                            const data = `
                        <tr>
                            <td>${counter++}</td>
                            <td class="oneLine"><img class="rounded-circle header-profile-user" src="${val.profile_image}" alt=""></td>
                            <td class="oneLine">${val.f_name}</td>
                            <td class="oneLine">${val.email}</td>
                            <td class="oneLine">${val.phone_no}</td>
                            // <td class="oneLine">${val.role == 0 ? 'Admin' : 'User'}</td>
                            <td nowrap>
                                <a href="{{ url('Admin/Manage-Users/Details/${val.id}/Page') }}" class="btn btn-success btn-sm view-btn" data-view-val="${val.id}">View</a>
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

@endsection