@extends('Admin.layout.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="m-5 ">
            
            <div id="center">
                
                <h2>Welcome To Admin Dashboard</h2>
               

            </div>





        </section>
    @endsection


    @section('script')
    @endsection


    @section('style')
        <style>
            #center {
                width: 400px;
                margin: auto;
                text-align: center;

                /* Optional Styling */
                padding: 20px;
                border-style: solid;
                border-color: #B6C7D6;
                border-radius: 20px;
               

            }
        </style>
    @endsection
