@extends('User.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Events</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Nav Tabs -->
        <ul class="nav nav-tabs" id="eventTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="latest-events-tab" data-bs-toggle="tab" href="#latest-events" role="tab" aria-controls="latest-events" aria-selected="true">Latest Events</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="completed-events-tab" data-bs-toggle="tab" href="#completed-events" role="tab" aria-controls="completed-events" aria-selected="false">Completed Events</a>
            </li>
        </ul>

        <div class="tab-content" id="eventTabsContent">
            <!-- Latest Events Tab -->
            <div class="tab-pane fade show active" id="latest-events" role="tabpanel" aria-labelledby="latest-events-tab">
                <div class="row" id="event_list_latest"></div>
            </div>
            <!-- Completed Events Tab -->
            <div class="tab-pane fade" id="completed-events" role="tabpanel" aria-labelledby="completed-events-tab">
                <div class="row" id="event_list_completed"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function fetchEvents(type) {
        let url = (type === 'latest') ? "{{ url('User/Events/1') }}" : "{{ url('User/Events/2') }}";
        
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                let list = response.data;
                let target = (type === 'latest') ? '#event_list_latest' : '#event_list_completed';

                $(target).empty();  // Clear existing content before appending new events

                $.each(list, function(index, val) {
                    let bookTicketsButton = '';
                    // Check if event is not completed
                    if (type === 'latest') {
                        bookTicketsButton = `
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ url('User/Tickets/Page/${val.id}') }}" class="btn btn-primary">
                                    <strong class="h4 text-white">Book Tickets</strong>
                                </a>
                            </div>
                        `;
                    }

                    $(target).append(`
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ url('User/Event-Details/${val.id}') }}">
                                        <img class="img-fluid rounded-sm" style="min-height: 200px" src="${val.event_banner_url}" alt="">
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="{{ url('User/Event-Details/${val.id}') }}" class="oneLine " data-bs-toggle="tooltip" title="${val.event_title}">
                                        <strong class="h4 text-primary">${val.event_title}</strong>
                                    </a>
                                </div>
                                ${bookTicketsButton} <!-- Only add the button if event is latest -->
                            </div>
                        </div>
                    `);
                });
            }
        });
    }

    $(document).ready(function() {
        // Load latest events by default
        fetchEvents('latest');

        // Change event lists when tabs are switched
        $('#eventTabs a').on('shown.bs.tab', function (e) {
            let target = $(e.target).attr('href');  // Get the target tab
            if (target === '#latest-events') {
                fetchEvents('latest');
            } else if (target === '#completed-events') {
                fetchEvents('completed');
            }
        });
    });
</script>

@endsection
