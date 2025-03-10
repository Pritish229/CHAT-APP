@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage Profile</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('Admin.Dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <form id="profileform" enctype="multipart/form-data" method="POST" action="javascript:void(0);">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <x-inputbox type="text" placeholder="Enter FullName" label="Full Name" id="f_name"
                            name="f_name" value="{{ old('f_name') }}" :required="true" />
                    </div>
                    <div class="col-lg-6 mb-2">
                        <x-inputbox type="text" placeholder="Enter Phone no" label="Phone no" id="phone_no"
                            name="phone_no" value="{{ old('phone_no') }}" :required="true" />
                    </div>
                    <div class="col-lg-6 mb-2">
                        <x-inputbox type="email" placeholder="Enter Email" label="Email" id="email" name="email"
                            value="{{ old('email') }}" :required="true" />
                    </div>
                    <div class="col-lg-6 mb-2">
                        <x-inputbox type="password" placeholder="Enter Password" label="Password" id="password"
                            name="password" value="{{ old('password') }}" />
                    </div>
                    <div class="col-lg-6 mb-2">
                        <x-inputbox type="password" placeholder="Enter Confirm Password" label="Confirm Password"
                            id="c_password" name="c_password" value="{{ old('password') }}" />
                    </div>
                    <div class="col-lg-4 mb-2">
                        <x-imageuploade inputId="customFile2" labelname="Select Image" id="profile_img" name="profile_image" labelId="profile_img"
                            previewId="profile_img_prev" :width="'50%'" :height="'100%'" />
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mb-2"
                            id="save-btn">Save</button>
                    </div>
                </div>
            </form>
        </section>
    @endsection

    @section('script')

    <script>
        function fatchProfile() {
            const userId = "{{ session()->get('user_id') }}";
                $.ajax({
                    type: "GET",
                    url: `{{ url('/Admin/profile/${userId}') }}`,
                    dataType: "json",
                    success: function (response) {
                        setInitialValues('profile_img_prev', `${response.profile_image}`, '50%', '100%');
                    }
                });
            }
            $(document).ready(function () {
                fatchProfile();
            });
    </script>
        <script>
            $('#profileform').validate({
                rules: {
                    f_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone_no: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    profile_image: {
                        extension: "jpg|jpeg|png" 
                    },
                    password: {
                        minlength: 6
                    },
                    c_password: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    f_name: {
                        required: "Full Name is required",
                        minlength: "Full Name must be at least 2 characters long"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    phone_no: {
                        required: "Phone number is required",
                        number: "Please enter a valid number",
                        minlength: "Phone number must be 10 digits",
                        maxlength: "Phone number must be 10 digits"
                    },
                    profile_image: {
                        required: "Profile image is required",
                        extension: "Please upload a valid image (jpg, jpeg, png, gif)"
                    },
                    password: {
                        minlength: "Password must be at least 6 characters long"
                    },
                    c_password: {
                        equalTo: "Confirm Password must match the Password"
                    },
                    messages: {
                        profile_image: {
                            extension: "Please upload a valid image file (jpg, jpeg, png)"
                        }
                    },
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.closest('div'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault(); // Prevent native form submission

                    let saveButton = $('#save-btn');
                    saveButton.prop('disabled', true).text('Saving...');

                    const admin_id = "{{ session()->get('user_id') }}"; // Fetch admin ID

                    $.ajax({
                        type: 'POST',
                        url: `{{ url('Admin/profile/${admin_id}/Update') }}`, 
                        data: new FormData(form),
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                        
                            
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Profile updated successfully!',
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                fatchUser()

                                saveButton.prop('disabled', false).text('Save');
                            } else {
                                saveButton.prop('disabled', false).text('Save');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong',
                                    text: 'Please try again',
                                    showConfirmButton: true
                                });
                            }
                        },
                        error: function() {
                            saveButton.prop('disabled', false).text('Save');
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: 'Please try again',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        </script>
    @endsection
