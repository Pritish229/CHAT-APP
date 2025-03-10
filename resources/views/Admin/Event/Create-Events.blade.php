@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create Events</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('Admin.Dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Create Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <form id="eventForm" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <x-inputbox type="text" placeholder="Enter Title" label="Title" id="title" name="title"
                            value="{{ old('title') }}" :required="true" />
                    </div>

                    <div class="col-lg-3 mb-2">
                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="text" class="form-control flatpickr-input active" id="event_date"
                                name="start_date" placeholder="Enter Start Date">
                        </div>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <x-inputbox type="number" placeholder="Available Tickets" label="Ticket's" id="ticket_no"
                            name="ticket_no" value="{{ old('ticket_no') }}" :required="true" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="">State</label>
                                <select class="form-select mb-2 select2" name="state_id" id="state_id"></select>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label for="">District</label>
                                <select class="form-select mb-2 select2" name="dist_id" id="dist_id">
                                    <option value="" selected disabled>Select District</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="">City</label>
                                <select class="form-select mb-2 select2" name="city_id" id="city_id">
                                    <option value="" selected disabled>Select City</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <x-inputbox type="number" placeholder="Enter Pincode" label="Pincode" id="pincode"
                                    name="pincode" value="{{ old('pincode') }}" :required="true" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-11">
                                <label for="imagelnput">Event Banner</label>
                                <input type="file" id="imagelnput" class="form-control mb-2" />
                            </div>
                            <div class="col-1 d-flex justify-content-end mt-4 pt-1">
                                <span><button type="button" class="btn btn-primary" id="cropButton">Crop</button></span>
                            </div>
                            <div class="col-lg-12" id="crop_area">
                                <img id="event_img" src="" alt=""
                                    style="max-width: 100%; height: auto; display: none;">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mb-2">
                        <label for="message">Event Description</label>
                        <textarea id="tiny" name="message"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary save hide mt-2" id="addNewButton">Add New</button>
            </form>
        </section>
    @endsection

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
        <script>
            $('.select2').select2({
                tags: false
            });

            $(".flatpickr-input").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });

            tinymce.init({
                selector: 'textarea#tiny',
                height: 400,
                menubar: false,
                skin: 'oxide',
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | media fullscreen | ' +
                    'forecolor backcolor emoticons',
                content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px }'
            });

            function stateList() {
                $('#state_id').html('<option value="" selected disabled>Select State</option>');
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/List-States') }}`,
                    dataType: "json",
                    success: function(response) {
                        let list = response.data;
                        if (list.length > 0) {
                            $.each(list, function(index, val) {
                                $('#state_id').append(
                                    `<option value="${val.state_id}">${val.state_title}</option>`);
                            });
                        }
                    }
                });
            }

            $('#state_id').change(function() {
                let state_id = $(this).val();
                $('#dist_id').html('<option value="" selected disabled>Select District</option>');
                $('#city_id').html('<option value="" selected disabled>Select City</option>');
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/List-District/${state_id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        let list = response.data;
                        $.each(list, function(index, val) {
                            $('#dist_id').append(
                                `<option value="${val.districtid}">${val.district_title}</option>`
                            );
                        });
                    }
                });
            });

            $('#dist_id').change(function() {
                let dist_id = $(this).val();
                $('#city_id').html('<option value="" selected disabled>Select City</option>');
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/List-City/${dist_id}') }}`,
                    dataType: "json",
                    success: function(response) {
                        let list = response.data;
                        $.each(list, function(index, val) {
                            $('#city_id').append(`<option value="${val.id}">${val.name}</option>`);
                        });
                    }
                });
            });

            $(document).ready(function() {
                stateList();
            });



            $(document).ready(function() {
                var cropper, croppedImageData;

                var $profileImg = $('#event_img');
                var $imageInput = $('#imagelnput');
                var $cropButton = $('#cropButton');

                $imageInput.on('change', function(e) {
                    $('#event_img').attr('src', '');
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            // Display the selected image in the preview container
                            $profileImg.attr('src', event.target.result).show();

                            // Destroy the previous cropper instance if it exists
                            if (cropper) {
                                cropper.destroy();
                                cropper = null;
                            }

                            // Initialize a new cropper instance on the newly selected image
                            cropper = new Cropper($profileImg[0], {
                                aspectRatio: false,
                                viewMode: 3,
                                responsive: true,
                                zoomable: true
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $cropButton.on('click', function() {
                    if (cropper) {
                        var canvas = cropper.getCroppedCanvas();
                        croppedImageData = canvas.toDataURL('image/png');
                        $('#event_img').attr('src', croppedImageData);
                        cropper.destroy();

                    }
                });

                $('#addNewButton').on('click', function(e) {
                    e.preventDefault();
                    var isValid = true;
                    var title = $('#title').val();
                    var ticket = $('#ticket_no').val();
                    var startDate = $('#event_date').val();
                    var state = $('#state_id').val();
                    var district = $('#dist_id').val();
                    var city = $('#city_id').val();
                    var pincode = $('#pincode').val();
                    var fileInput = $('#imagelnput')[0];
                    var file = fileInput.files[0];

                    // Clear previous error messages
                    $('.text-danger').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    if (!title) {
                        isValid = false;
                        $('#title').addClass('is-invalid').after(
                            '<div class="text-danger">Title is required</div>');
                    }
                    if (!ticket) {
                        isValid = false;
                        $('#ticket_no').addClass('is-invalid').after(
                            '<div class="text-danger">Ticket number is required</div>');
                    }
                    if (!startDate) {
                        isValid = false;
                        $('#event_date').addClass('is-invalid').after(
                            '<div class="text-danger">Event date is required</div>');
                    }
                    if (!state) {
                        isValid = false;
                        $('#state_id').next('.select2-container').after(
                            '<div class="text-danger">State is required</div>');
                    }
                    if (!district) {
                        isValid = false;
                        $('#dist_id').next('.select2-container').after(
                            '<div class="text-danger">District is required</div>');
                    }
                    if (!city) {
                        isValid = false;
                        $('#city_id').next('.select2-container').after(
                            '<div class="text-danger">City is required</div>');
                    }
                    if (!pincode) {
                        isValid = false;
                        $('#pincode').addClass('is-invalid').after(
                            '<div class="text-danger">Pincode is required</div>');
                    }

                    // Check if the file is an image
                    if (!file || !file.type.match('image.*') || !['image/jpeg', 'image/png', 'image/webp']
                        .includes(file.type)) {
                        isValid = false;
                        $('#imagelnput').addClass('is-invalid').after(
                            '<div class="text-danger">Please upload a valid image (jpg, jpeg, png, webp)</div>'
                            );
                    }

                    if (!isValid) return;

                    $('#addNewButton').prop('disabled', true).text('Adding..');
                    var formData = new FormData();
                    let message = tinymce.get('tiny').getContent('');
                    formData.append('event_title', title);
                    formData.append('total_tickets', ticket);
                    formData.append('event_date', startDate);
                    formData.append('state_id', state);
                    formData.append('district_id', district);
                    formData.append('city_id', city);
                    formData.append('pincode', pincode);
                    formData.append('event_desc', message);
                    formData.append('event_banner', croppedImageData); // This should be the base64 image

                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: `{{ url('Admin/Store-Events') }}`,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Event Created Successfully!',
                                    showConfirmButton: true,
                                    timer: 1500
                                });

                                tinymce.get('tiny').setContent('');
                                stateList();
                                $('#dist_id').html(
                                    '<option value="" selected disabled>Select District</option>'
                                    );
                                $('#city_id').html(
                                    '<option value="" selected disabled>Select City</option>');
                                $('#eventForm')[0].reset();
                                cropper = null;
                                croppedImageData = null;
                                $('#event_img').attr('src', '');
                                $('#addNewButton').prop('disabled', false).text('Add New');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to Create Event!',
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                $('#addNewButton').prop('disabled', false).text('Add New');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON.errors) {
                                Object.entries(xhr.responseJSON.errors).forEach(([key,
                                messages]) => {
                                    let field = $(`[name="${key}"]`);
                                    if (field.hasClass('select2-hidden-accessible')) {
                                        field.next('.select2-container').after(
                                            `<div class="text-danger">${messages[0]}</div>`
                                            );
                                    } else {
                                        field.addClass('is-invalid').after(
                                            `<div class="text-danger">${messages[0]}</div>`
                                            );
                                    }
                                });
                            }
                        },
                    });
                });

            });
        </script>
    @endsection
